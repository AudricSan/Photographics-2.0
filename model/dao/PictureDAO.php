<?php

use photographics\Picture;
use photographics\Env;

class PictureDAO extends Env
{
    //DON'T TOUCH IT, LITTLE PRICK
    private $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    private $username;
    private $password;
    private $host;
    private $dbname;
    private $table;
    private $connection;

    public function __construct()
    {
        // Change the values according to your hosting.
        $this->username = parent::env('DB_USERNAME', 'root');     //The login to connect to the DB
        $this->password = parent::env('DB_PASSWORD', '');         //The password to connect to the DB
        $this->host =     parent::env('DB_HOST', 'localhost');    //The name of the server where my DB is located
        $this->dbname =   parent::env('DB_NAME');                 //The name of the DB you want to attack.
        $this->table =    "picture";                              // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} ORDER BY picture_name");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $picture = array();

            foreach ($results as $result) {
                array_push($picture, $this->create($result));
            }

            return $picture;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE picture_id = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create($result);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function create($result)
    {
        if (!$result) {
            return false;
        }

        return new Picture(
            $result['picture_id'],
            $result['picture_name'],
            $result['picture_description'],
            $result['picture_link'],
            $result['picture_sharable']
        );
    }

    public function delete($id)
    {
        if (!$id) {
            return false;
        }

        $oldpicture = $this->fetch($id);
        $oldpicture = $oldpicture->_link;

        $rootHost = $_SERVER['DOCUMENT_ROOT'];
        $imglink = $rootHost . '/public/images/img/' . $oldpicture;

        if (file_exists($imglink)) {
            unlink($imglink);
            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE picture_id = ?");
                $statement->execute([
                    $id
                ]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
        } else {
            echo 'Could not delete ' . $oldpicture . ', file does not exist';
        }

        //PHP Header Brocken for any reason => use Js redirect tu patch//
        // header('location: /admin/picture');
        echo "<script language='Javascript'>document.location.replace('/admin/picture');</script>";
    }

    public function store($data)
    {
        if (empty($data)) {
            return false;
        }

        $name = $this->checkInput($data['title']);
        $desc = $this->checkInput($data['desc']);
        $share = ($data['share'] === 'on') ? 1 : 0;
        $imgroot = $_SERVER['SERVER_NAME'] . '/public/images';

        $error = [];

        $image              = $this->checkInput($_FILES['file']['name']);
        $imagePath          = SITE_ROOT . '\\images\\img\\' . $image;
        $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);


        var_dump($image);
        var_dump($imagePath);
        var_dump($imageExtension);

        if (empty($image)) {
            $error[] = 'Ce champ ne peut pas être vide';
        } else {
            if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg") {
                $error[] = "Les fichiers autorises sont: .jpg, .jpeg, .png";
            }

            if ($_FILES["file"]["size"] > 500000) {
                $error[] = "Le fichier ne doit pas depasser les 500KB";
            }

            if (empty($error)) {
                if (file_exists($imagePath)) {
                    $error[] = "Files Already Exist";
                } else {
                    if (!move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath)) {
                        $error[] = "Il y a eu une erreur lors de l'upload";
                    }
                }
            }
        }

        if (!empty($error)) {
            $_SESSION['error'] = $error;
            var_dump($error);
            // header('location: /admin/newpicture');
            // die;
        }

        $nb = count($this->fetchAll());
        ++$nb;

        $picture = $this->create([
            'picture_id' => 0,
            'picture_name' => $name,
            'picture_description' => $desc,
            'picture_link' => $image,
            'picture_sharable' => $share
        ]);

        if ($picture) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (
                picture_name, picture_description, picture_link, picture_sharable) VALUES (?, ?, ?, ?)");
                $statement->execute([
                    $picture->_name,
                    $picture->_description,
                    $picture->_link,
                    $picture->_sharable
                ]);

                $picture->_id = $this->connection->lastInsertId();

                var_dump($data);
                $regex = '/tagid=[0-9]+/i';
                $tags = [];
                foreach ($data as $key => $value) {
                    if (preg_match($regex, $key)) {
                        $tags[] = $value;
                    }
                }

                var_dump($tags);
                var_dump($picture);

                // MULTIPLE TAGG INPUT AND UPLOAD
                $pictureTagDAO = new PictureTagDAO;
                foreach ($tags as $tag) {
                    $pictureTagDAO->store($tag, $picture->_id);
                }
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
        header('location: /admin/picture');
    }

    public function update($id, $data)
    {
        if (empty($data)) {
            return false;
        }

        $data['share'] = ($data['share'] === 'on') ? 1 : 0;

        $picture = $this->create([
            "picture_id" => $id,
            'picture_name' => $data['title'],
            'picture_description' => $data['desc'],
            'picture_link' => $data['link'],
            'picture_sharable' => $data['share'],
        ]);

        if ($picture) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET picture_name = ?, picture_description = ?, picture_link = ?, picture_sharable = ? WHERE picture_id = ?");
                $statement->execute([
                    $picture->_name,
                    $picture->_description,
                    $picture->_link,
                    $picture->_sharable,
                    $picture->_id
                ]);

                $ptDAO = new PictureTagDAO;
                $pts = $ptDAO->fetchByPic($picture->_id);

                foreach ($pts as $pt) {
                    if ($pt->_pic === $picture->_id) {
                        $ptDAO->deleteByPic($picture->_id);
                    }
                }

                $regex = '/tagid=[0-9]+/i';
                $tags = [];
                foreach ($data as $key => $value) {
                    if (preg_match($regex, $key)) {
                        $tags[] = $value;
                    }
                }

                foreach ($tags as $tag) {
                    $ptDAO->store($tag, $picture->_id);
                }
                
            } catch (PDOException $e) {
                var_dump($e->getMessage());
                return false;
            }
        }
        header('location: /admin/picture');
    }
}
