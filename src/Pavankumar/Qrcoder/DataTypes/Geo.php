<?php namespace Pavankumar\Qrcoder\DataTypes;


class Geo implements DataTypeInterface
{

    private $prefix = 'geo:';

    private $separator = ',';

    protected $latitude;

    private $longitude;

    public function create(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");

        $text = $arguments[0];

        if (array_key_exists("latitude", $text)) $this->latitude = $text["latitude"];
        if (array_key_exists("longitude", $text)) $this->longitude = $text["longitude"];

    }

    public function __toString()
    {
        return $this->prefix . $this->latitude . $this->separator . $this->longitude;
    }

}