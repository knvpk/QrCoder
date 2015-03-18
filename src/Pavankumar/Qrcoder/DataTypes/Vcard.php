<?php namespace Pavankumar\Qrcoder\DataTypes;


class Vcard implements DataTypeInterface
{


    private $prefix = 'BEGIN:VCARD \r\n VERSION:3.0 \r\n ';
    private $suffix = 'END:VCARD';
    private $separator = " \r\n ";

    private $firstname;
    private $lastname;
    private $displayname;
    private $organization;
    private $email;
    private $url;
    private $mobile;
    private $address;

    private $mobileTypes = ["voice", "work", "pref"];
    private $addressTypes = ["intl", "work", "postal", "parcel"];


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
            $buildString .= "N:" . $this->firstname . ";" . $this->lastname;
        }
        if (isset($this->displayname)) $buildString .= $this->separator . "FN:" . $this->displayname;
        if (isset($this->organization)) $buildString .= $this->separator . "ORG:" . $this->organization;
        if (isset($this->url)) $buildString .= $this->separator . "URL:" . $this->url;
        if (isset($this->email)) $buildString .= $this->separator . "EMAIL:" . $this->email;

//        if (isset($this->mobile) && is_array($this->mobile)) {
//            foreach ($this->mobile as $mobile) {
//                $this->setMobile($buildString, $mobile);
//            }
//        }

        if (isset($this->mobile)) $buildString .= $this->separator . "TEL;TYPE=work:" . $this->mobile;
        if (isset($this->address)) $buildString .= $this->separator . "ADR;TYPE=work:" . $this->address;

        return $buildString . $this->suffix;
    }

//    private function setMobile($buildString,$mobile)
//    {
//
//    }


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