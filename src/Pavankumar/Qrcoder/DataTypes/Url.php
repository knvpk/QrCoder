<?php namespace Pavankumar\Qrcoder\DataTypes;
/**
 * Simple Laravel QrCode Generator
 * A simple wrapper for the popular BaconQrCode made for Laravel.
 *
 * @link http://www.simplesoftware.io
 * @author SimpleSoftware support@simplesoftware.io
 *
 */

class Url implements DataTypeInterface
{

    /**
     * The prefix of the QrCode
     *
     * @var string
     */
    private $prefix = ['http://', 'https://'];


    /**
     * The latitude
     *
     * @var
     */
    protected $url;

    protected $secure = false;


    public function create(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");

        $text = $arguments[0];

        if (array_key_exists("url", $text)) $this->url = $text["url"];
        if (array_key_exists("secure", $text)) $this->secure = $text["secure"];

    }

    public function __toString()
    {
        if ($this->secure) {
            return $this->prefix[1] . $this->url;
        } else {
            return $this->prefix[0] . $this->url;
        }
    }

}