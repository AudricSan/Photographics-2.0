<?php
namespace photographics;
class Tag
{
    private int     $_id;
    private string  $_name;
    private string  $_description;

    //Constructeur
    public function __construct($id, $name, $desc)
    {
        $this->_name = $name;
        $this->_description = $desc;
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