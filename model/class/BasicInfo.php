<?php
namespace photographics;
class BasicInfo
{
    private int     $_id;
    private string  $_name;
    private string  $_content;

    //Constructeur
    public function __construct($id, $name, $content)
    {
        $this->_name = $name;
        $this->_content = $content;
        
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