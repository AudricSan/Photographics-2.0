<?php

namespace photographics;

class Admin
{
    private int     $_id;

    private string  $_name;
    private string  $_mail;
    private string  $_password;
    private int     $_role;

    //Manufacturer
    public function __construct($id, $name, $mail, $password, $role)
    {
        $this->_name = $name;
        $this->_mail = $mail;
        $this->_password = $password;

        $this->_id = intval($id);
        $this->_role = intval($role);
    }

    //SUPER SETTER
    public function __set($prop, $value)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop = $value;
        }
    }

    //SUPER GETTER
    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
}
