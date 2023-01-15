<?php
namespace photographics;
class PictureTag
{
    private int $_id;
    private int $_pic;
    private int $_tag;

    //Constructeur
    public function __construct($id, $pic, $tag)
    {  
        $this->_id = intval($id);
        $this->_pic = intval($pic);
        $this->_tag = intval($tag);
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