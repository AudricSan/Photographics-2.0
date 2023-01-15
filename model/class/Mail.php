<?php
namespace photographics;
class Mail
{
    private string $_to;
    private string $_subject;
    private string $_message;
    private string $_additional_headers;
    private string $_additional_params;

    //Constructeur
    public function __construct($to, $subject, $message, $additional_headers, $additional_params)
    {
        $this->_to = $to;
        $this->_subject = $subject;
        $this->_message = $message;
        $this->_additional_headers = $additional_headers;
        $this->_additional_params = $additional_params;
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