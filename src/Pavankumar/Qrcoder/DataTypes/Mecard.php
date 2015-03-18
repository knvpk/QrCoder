<?php namespace Pavankumar\Qrcoder\DataTypes;



class Mecard implements DataTypeInterface
{


    private $prefix = 'MECARD:';

    private $firstname;
    private $lastname;
    private $mobile;
    private $email;
    private $url;

    private $notes;
    private $bday;
    private $address;


    public function create(Array $arguments)
    {
        $this->setProperties($arguments);
    }

    public function __toString()
    {
        return $this->buildEmailString();
    }

    private function buildEmailString()
    {

        $buildString = $this->prefix;
        if (isset($this->firstname) || isset($this->lastname)) {
            $buildString .= "N:" . $this->firstname . "," . $this->lastname;
        }
        if (isset($this->mobile)) $buildString .= "TEL:" . $this->mobile;
        if (isset($this->email)) $buildString .= "EMAIL:" . $this->mobile;
        if (isset($this->url)) $buildString .= "URL:" . $this->mobile;
        if (isset($this->notes)) $buildString .= "Note:" . $this->mobile;
        if (isset($this->bday)) $buildString .= "BDAY:" . $this->mobile;
        if (isset($this->address)) $buildString .= "ADR:" . $this->mobile;

        return $buildString;
    }


    private function setProperties(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");


        $text = $arguments[0];


        if (array_key_exists('firstname', $text)) $this->firstname = $text["firstname"];
        if (array_key_exists('lastname', $text)) $this->lastname = $text["lastname"];
        if (array_key_exists('email', $text)) $this->email = $text["email"];
        if (array_key_exists('url', $text)) $this->url = $text["url"];
        if (array_key_exists('mobile', $text)) $this->mobile = $text["mobile"];
        if (array_key_exists('notes', $text)) $this->notes = $text["notes"];
        if (array_key_exists('bday', $text)) $this->bday = $text["bday"];
        if (array_key_exists('address', $text)) $this->lastname = $text["address"];


    }


    private function setEmail($email)
    {

        if ($this->isValidEmail($email)) $this->email = $email;
    }


    private function isValidEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email provided');
        }

        return true;
    }

}