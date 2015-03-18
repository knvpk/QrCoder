<?php namespace Pavankumar\Qrcoder\DataTypes;


class PhoneNumber implements DataTypeInterface
{

    private $prefix = 'tel:';

    private $phoneNumber;


    public function create(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");
        $text = $arguments[0];
        if (array_key_exists("number", $text)) $this->phoneNumber = $text["number"];

    }

    public function __toString()
    {
        return $this->prefix . $this->phoneNumber;
    }

}