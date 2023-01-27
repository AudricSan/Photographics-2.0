<?php
use photographics\Tag;
use photographics\Env;

class TagDAO extends Env
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
        $this->table =    "tag";                                // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $tags = array();

            foreach ($results as $result) {
                array_push($tags, $this->create($result));
            }

            // var_dump($tags);
            return $tags;

        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE tag_id = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create($result);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
    
    public function fetchByName($name)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE tag_name = ?");
            $statement->execute([$name]);
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

        // NOTE DUMP OF OBJECT CREATE
        // var_dump($result);
        return new Tag(
            $result['tag_id'],
            $result['tag_name'],
            $result['tag_description'],
        );
    }

    public function delete($id)
    {
        if (!$id) {
            return false;
        }

        $tags = $this->fetchAll();
        $tagcount = count($tags);

        if ($tagcount > 1) {
            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE tag_id = ?");
                $statement->execute([
                    $id
                ]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
        }else{
            $_SESSION['error'] = "You can't have less than 1 Tag";
        }

        header('location: /admin/tag');
        die;
    }

    public function store($data)
    {

        if (empty($data)) {
            return false;
        }

        if ($this->fetchByName($data['title'])) {
            $_SESSION['error'] = 'Already Exist';
            header('location: /admin/newtag');
            die;
        }

        $tag = $this->create([
            "tag_id" => 0,
            'tag_name'  => $data['title'],
            'tag_description'  => $data['desc'],
        ]);

        if ($tag) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (tag_name, tag_description) VALUES (?, ?)");
                $statement->execute([
                    $tag->_name,
                    $tag->_description
                ]);

            } catch (PDOException $e) {
                echo $e;
            }
        }

        header('location: /admin/tag');
        die;
    }

    public function update($id, $data)
    {
        if (empty($data)) {
            return false;
        }

        $tag = $this->create([
            'tag_id' => $id,
            'tag_name' => $data['title'],
            'tag_description' => $data['desc'],
        ]);

        if ($tag) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET tag_name = ?, tag_description = ? WHERE tag_id = ?");
                $statement->execute([
                    $tag->_name,
                    $tag->_description,
                    $tag->_id
                ]);

            } catch (PDOException $e) {
                var_dump($e->getMessage());
                return false;
            }
        }
        header('location: /admin/tag');
    }
}
