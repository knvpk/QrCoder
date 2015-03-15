<?php namespace Pavankumar\Qrcoder\DataTypes;
/**
 * Simple Laravel QrCode Generator
 * A simple wrapper for the popular BaconQrCode made for Laravel.
 *
 * @link http://www.simplesoftware.io
 * @author SimpleSoftware support@simplesoftware.io
 *
 */

class Geo implements DataTypeInterface
{

    /**
     * The prefix of the QrCode
     *
     * @var string
     */
    private $prefix = 'geo:';

    /**
     * The separator between the variables
     *
     * @var string
     */
    private $separator = ',';

    /**
     * The latitude
     *
     * @var
     */
    protected $latitude;

    /**
     * The longitude
     *
     * @var
     */
    private $longitude;

    /**
     * Generates the DataType Object and sets all of its properties.
     *
     * @param $arguments
     * @return void
     */
    public function create(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");

        $text = $arguments[0];

        if (array_key_exists("latitude", $text)) $this->latitude = $text["latitude"];
        if (array_key_exists("longitude", $text)) $this->longitude = $text["longitude"];

    }

    /**
     * Returns the correct QrCode format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->prefix . $this->latitude . $this->separator . $this->longitude;
    }

}