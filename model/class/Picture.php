<?php
namespace photographics;
class Picture
{
    private int     $_id;
    private string  $_name;
    private string  $_description;
    private string  $_link;
    private int     $_tag;
    private int     $_sharable;

    //Constructeur
    public function __construct($id, $name, $desc, $link, $tag, $share)
    {
        $this->_name = $name;
        $this->_description = $desc;
        $this->_link = $link;
        
        $this->_id = intval($id);
        $this->_tag = intval($tag);
        $this->_sharable = intval($share);
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