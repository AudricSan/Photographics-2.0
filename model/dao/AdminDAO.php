<?php

use photographics\Admin;
use photographics\Env;

class AdminDAO extends Env
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
        // Change the values according to your hosting IN ENV FILES!.
        $this->username = parent::env('DB_USERNAME', 'root');     //The login to connect to the DB
        $this->password = parent::env('DB_PASSWORD', '');         //The password to connect to the DB
        $this->host =     parent::env('DB_HOST', 'localhost');    //The name of the server where my DB is located
        $this->dbname =   parent::env('DB_NAME');                 //The name of the DB you want to attack.
        $this->table =    "admin";                                // The table to attack

        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function fetchAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $admins = array();

            foreach ($results as $result) {
                array_push($admins, $this->create($result));
            }

            return $admins;
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetch($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE Admin_ID = ?");
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create($result);
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function fetchByMail($mail)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE admin_mail = ?");
            $statement->execute([$mail]);
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

        return new Admin(
            $result['admin_id'],
            $result['admin_name'],
            $result['admin_mail'],
            $result['admin_password'],
            $result['admin_role']
        );
    }

    public function delete($id)
    {
        if (!$id) {
            return false;
        }

        $admins = $this->fetchAll();
        $adminsCount = count($admins);

        if ($adminsCount > 1) {
            try {
                $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE Admin_ID = ?");
                $statement->execute([
                    $id
                ]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
        } else {
            session_start();
            $_SESSION['error']['admin']['delete'] = "You can't have less than 1 Admin";
        }
        header('location: /admin/poeple');
    }

    public function store($data)
    {

        if (empty($data)) {
            return false;
        }

        $admin = $this->create([
            "admin_id"       => 0,
            'admin_mail'     => $data['mail'],
            'admin_password' => $data['pass'],
            'admin_name'     => $data['name'],
            'admin_role'     => $data['role']
        ]);

        if ($admin) {
            try {
                $statement = $this->connection->prepare("INSERT INTO {$this->table} (Admin_Mail, Admin_Password, Admin_Name, Admin_Role) VALUES (?, ?, ?, ?)");
                $statement->execute([
                    $admin->_mail,
                    $admin->_password,
                    $admin->_name,
                    $admin->_role
                ]);

                $admin->id = $this->connection->lastInsertId();
            } catch (PDOException $e) {
                echo $e;
            }
        }

        header('location: /admin/poeple');
    }

    public function update($id, $data)
    {
        if (empty($data) || empty($id)) {
            return false;
        }

        $data['pass'] = password_hash($data['pass'], PASSWORD_BCRYPT);
        $data['mail'] = filter_var($data['mail'], FILTER_VALIDATE_EMAIL);

        if ($data['mail'] === false) {
            echo 'false';
            header('location: /admin/poeple');
            return false;
        }

        $admin = $this->create([
            "admin_id"       => $id,
            'admin_name'     => $data['name'],
            'admin_mail'     => $data['mail'],
            'admin_password' => $data['pass'],
            'admin_role'     => $data['role']
        ]);

        if ($admin) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET
                admin_name = ?,
                admin_mail = ?,
                admin_password = ?,
                admin_role = ? WHERE
                admin_id = ?");
                $statement->execute([
                    $admin->_name,
                    $admin->_mail,
                    $admin->_password,
                    $admin->_role,
                    $admin->_id
                ]);
            } catch (PDOException $e) {
                var_dump($e->getMessage());
                return false;
            }
        }

        header('location: /admin/poeple');
    }

    public function login($data)
    {
        session_unset();
        $error = [];

        if (!isset($data)) {
            $error[] = "No Data Set";
        }

        if (empty($data['login']) || empty($data['pass'])) {
            $error[] = "Not Login Or Passowrd Set";
        }

        if (isset($error)) {
            goto error;
        }

        $existAdmin = $this->fetchByMail($data['login']);
        if (!$existAdmin) {
            $error[] = "Not Exist";
            goto error;
        }

        $pass = $data['pass'];
        $dbpass = $existAdmin->_password;

        if (!password_verify($pass, $dbpass)) {
            $error[] = "Not Not Good Pass Or User Not Exist";
            goto error;
        }

        $_SESSION['logged'] = $existAdmin->_id;
        header('location: /admin');

        error:
        $_SESSION['error'] = $error;
        header('location: /admin/login');
    }
}
