<?php

use photographics\BasicInfo;
use photographics\Env;

class BasicInfoDAO extends Env
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
        $this->table =    "basicinfo";                            // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} ORDER BY bi_id");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $basicinfo = array();

            foreach ($results as $result) {
                array_push($basicinfo, $this->create($result));
            }

            return $basicinfo;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($bi_name)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE bi_id = ?");
            $statement->execute([$bi_name]);
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
        return new BasicInfo(
            $result['bi_id'],
            $result['bi_name'],
            $result['bi_content'],
        );
    }

    public function delete($id)
    {
        if (!$id) {
            return false;
        }
        
        try {
            $statement = $this->connection->prepare("UPDATE {$this->table} SET bi_content = 'NULL' WHERE bi_id = ?");
            $statement->execute([
                $id
            ]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }

        echo "<script language='Javascript'>document.location.replace('/admin');</script>";
    }

    public function store($data)
    {
        if (empty($data)) {
            return false;
        }
        $basicinfo = $this->create([
            "basicinfo_id" => 0,
            'basicinfo_name'  => $data['name'],
            'basicinfo_content' => $data['content']
        ]);

        if ($basicinfo) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (bi_name, bi_content) VALUES (?, ?)");
                $statement->execute([
                    $basicinfo->_name,
                    $basicinfo->_content
                ]);

                $basicinfo->id = $this->connection->lastInsertId();
                return $basicinfo;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        echo "<script language='Javascript'>document.location.replace('/admin');</script>";
    }

    public function update($id, $data)
    {
        if (empty($data)) {
            return false;
        }

        $old = $this->fetch($data['id']);

        $basicinfo = $this->create([
            'bi_id' => $old->_id,
            'bi_name' => $old->_name,
            'bi_content' => $data['content'],
        ]);

        if ($basicinfo) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET bi_name = ?, bi_content = ? WHERE bi_id = ?");
                $statement->execute([
                    $basicinfo->_name,
                    $basicinfo->_content,
                    $basicinfo->_id
                ]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
                return false;
            }
        }

        echo "<script language='Javascript'>document.location.replace('/admin');</script>";
    }
}
