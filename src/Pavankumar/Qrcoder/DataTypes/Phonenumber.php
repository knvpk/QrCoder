<?php namespace Pavankumar\Qrcoder\DataTypes;
/**
 * Simple Laravel QrCode Generator
 * A simple wrapper for the popular BaconQrCode made for Laravel.
 *
 * @link http://www.simplesoftware.io
 * @author SimpleSoftware support@simplesoftware.io
 *
 */

class PhoneNumber implements DataTypeInterface
{

    /**
     * The prefix of the QrCode
     *
     * @var string
     */
    private $prefix = 'tel:';

    /**
     * The phone number
     *
     * @var
     */
    private $phoneNumber;


    public function create(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");
        $text = $arguments[0];
        if (array_key_exists("number", $text)) $this->phoneNumber = $text["number"];

    }

    /**
     * Returns the correct QrCode format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->prefix . $this->phoneNumber;
    }

}