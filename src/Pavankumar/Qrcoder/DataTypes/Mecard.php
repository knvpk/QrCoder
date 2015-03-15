<?php namespace Pavankumar\Qrcoder\DataTypes;


/**
 * Simple Laravel QrCode Generator
 * A simple wrapper for the popular BaconQrCode made for Laravel.
 *
 * @link http://www.simplesoftware.io
 * @author SimpleSoftware support@simplesoftware.io
 *
 */
class Mecard implements DataTypeInterface
{

    /**
     * The prefix of the QrCode
     *
     * @var string
     */
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

        $text = $this->prefix;
        if (isset($this->firstname) || isset($this->lastname)) {
            $text .= "N:" . $this->firstname . "," . $this->lastname;
        }
        if (isset($this->mobile)) $text .= "TEL:" . $this->mobile;
        if (isset($this->email)) $text .= "EMAIL:" . $this->mobile;
        if (isset($this->url)) $text .= "URL:" . $this->mobile;
        if (isset($this->notes)) $text .= "Note:" . $this->mobile;
        if (isset($this->bday)) $text .= "BDAY:" . $this->mobile;
        if (isset($this->address)) $text .= "ADR:" . $this->mobile;


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