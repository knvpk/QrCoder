<?php namespace Pavankumar\Qrcoder\DataTypes;


class Url implements DataTypeInterface
{


    private $prefix = ['http://', 'https://'];


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