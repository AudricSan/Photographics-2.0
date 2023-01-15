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

    public function fetchTags(){
        try {
            $statement = $this->connection->prepare("SELECT picture_tag, COUNT(picture_tag) FROM picture GROUP BY picture_tag");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return ($result);
        } catch (PDOException $e)  {
            var_dump($e);
        }
    }
    
    public function fetchByTag($id){
        try {
            $statement = $this->connection->prepare("SELECT picture_id FROM `picture` WHERE picture_tag = ?");
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return ($result);
        } catch (PDOException $e)  {
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
            $result['picture_tag'],
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

        session_start();
        $imgroot = $_SESSION['rootDoc'] . "/public/images";

        $image              = $this->checkInput($_FILES['file']["name"]);
        $imagePath          = $imgroot . '/img/' . basename($image);
        $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);

        if (empty($image)) {

            $imageError = 'Ce champ ne peut pas être vide';

        } else {
            $isUploadSuccess = true;

            if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg") {
                $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png";
                $isUploadSuccess = false;
            }

            if ($_FILES["file"]["size"] > 500000) {
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }

            if ($isUploadSuccess) {
                if (!move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath)) {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                }
            }
        }

        if ($isUploadSuccess != true) {
            $_SESSION['error']['image']['upload'] = $imageError;
            header('location: /admin/picture');
            exit;
        }
        
        $picture = $this->create([
            'picture_id' => 0,
            'picture_name' => $name,
            'picture_description' => $desc,
            'picture_link' => $image,
            'picture_tag' => $data['tag'],
            'picture_sharable' => $share
        ]);

        if ($picture) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (
                picture_name, picture_description, picture_link, picture_tag, picture_sharable) VALUES (?, ?, ?, ?, ?)");
                $statement->execute([
                    $picture->_name,
                    $picture->_description,
                    $picture->_link,
                    $picture->_tag,
                    $picture->_sharable
                ]);

                $picture->_id = $this->connection->lastInsertId();

                include('PictureTagDAO.php');

                foreach ($data as $key => $value) {
                    if (strpos($key, 'tag') !== false) {
                        $pictureTagDAO = new PictureTagDAO;
                        $result = $pictureTagDAO->store($value, $picture->_id);
                    }
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
        var_dump($data);
        $data['share'] = (isset($data['share'])) ? 1 : 0;

        $picture = $this->create([
            "picture_id" => $id,
            'picture_name' => $data['title'],
            'picture_description' => $data['desc'],
            'picture_link' => $data['link'],
            'picture_tag' => $data['tag'],
            'picture_sharable' => $data['share'],
        ]);

        var_dump($picture);
        if ($picture) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET picture_name = ?, picture_description = ?, picture_link = ?, picture_tag = ?, picture_sharable = ? WHERE picture_id = ?");
                $statement->execute([
                    $picture->_name,
                    $picture->_description,
                    $picture->_link,
                    $picture->_tag,
                    $picture->_sharable,
                    $picture->_id
                ]);

                //PICTURE CAN HAVE MULTIPLE TAGS => BUGS
                // include('PictureTagDAO.php');
                // // var_dump($picture);

                // //FIXME CANT EDIT TAGS ATRIBUTE TO AN IMAGE
                // $pictureTagDAO = new PictureTagDAO;
                // $pictureByTag = $pictureTagDAO->fetchByPic($picture->_id);
                // $pictureTag = $pictureTagDAO->fetchAll();

                // $tags = array();
                // foreach ($data as $key => $value) {
                //     if (strpos($key, 'tag') !== false) {
                //         array_push($tags, $value);
                //     }
                // }

                // if (!empty($pictureByTag)) {
                //     foreach ($pictureByTag as $key => $value) {
                //         if ($value->_pic === $picture->_id) {
                //             if (!in_array($value->_tag, $tags)) {
                //                 $pictureTagDAO->store($value, $picture->_id);
                //             }
                //         }
                //     }
                // } else {
                //     foreach ($tags as $key => $value) {
                //         $pictureTagDAO->store($value, $picture->_id);
                //     }
                // }
                //END
            } catch (PDOException $e) {
                var_dump($e->getMessage());
                return false;
            }
        }

        header('location: /admin/picture');
    }
}
