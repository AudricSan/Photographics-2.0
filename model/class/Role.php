<?php
namespace photographics;
class Role
{
    private int     $_id;
    private string  $_name;

    //Constructeur
    public function __construct($id, $name)
    {
        $this->_name = $name;
        $this->_id = intval($id);
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