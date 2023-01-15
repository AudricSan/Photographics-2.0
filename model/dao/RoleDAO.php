<?php
use photographics\Role;
use photographics\Env;

class RoleDAO extends Env
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
        $this->table =    "role";                                // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $role = array();

            foreach ($results as $result) {
                array_push($role, $this->create($result));
            }

            return $role;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE role_id = ?");
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

        // NOTE DUMP OF OBJECT CREATE
        // var_dump($result);
        return new Role(
            $result['role_id'],
            $result['role_name']
        );
    }

    public function delete($id)
    {
        if (!$id) {
            return false;
        }
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE role_id = ?");
            $statement->execute([
                $id
            ]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function store($data)
    {

        if (empty($data)) {
            return false;
        }

        $role = $this->create([
            "role_id" => 0,
            'role_name'  => $data['name']
        ]);

        if ($role) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (role_name) VALUES (?)");
                $statement->execute([
                    $role->_name
                ]);

                $role->id = $this->connection->lastInsertId();
                return $role;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
    }

    public function update($id, $data)
    {
        if (empty($data)) {
            return false;
        }

        $role = $this->create([
            "_id" => $id,
            '_name' => $data['name']
        ]);

        if ($role) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET role_name = ? WHERE role_id = ?");
                $statement->execute([
                    $role->_name,
                    $role->_id
                ]);

                return $role;
            } catch (PDOException $e) {
                var_dump($e->getMessage());
                return false;
            }
        }
    }
}
