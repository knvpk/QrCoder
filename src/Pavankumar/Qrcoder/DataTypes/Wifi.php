<?php namespace Pavankumar\Qrcoder\DataTypes;
/**
 * Simple Laravel QrCode Generator
 * A simple wrapper for the popular BaconQrCode made for Laravel.
 *
 * @link http://www.simplesoftware.io
 * @author SimpleSoftware support@simplesoftware.io
 *
 */

class WiFi implements DataTypeInterface
{

    /**
     * The prefix of the QrCode
     *
     * @var string
     */
    private $prefix = 'WIFI:';

    /**
     * The separator between the variables
     *
     * @var string
     */
    private $separator = ';';

    /**
     * The encryption of the network.  WEP or WPA
     *
     * @var string
     */
    private $encryption;

    /**
     * The SSID of the WiFi network.
     *
     * @var string
     */
    private $ssid;

    /**
     * The password of the network
     *
     * @var string
     */
    private $password;

    /**
     * Whether the network is a hidden SSID or not.
     *
     * @var boolean
     */
    private $hidden;

    /**
     * Generates the DataType Object and sets all of its properties.
     *
     * @param $arguments
     * @return void
     */
    public function create(Array $arguments)
    {
        $this->setProperties($arguments);
    }

    /**
     * Returns the correct QrCode format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->buildWifiString();
    }

    /**
     * Builds the WiFi string
     *
     * @return string
     */
    private function buildWifiString()
    {
        $wifi = $this->prefix;

        if (isset($this->encryption)) $wifi .= 'T:' . $this->encryption . $this->separator;
        if (isset($this->ssid)) $wifi .= 'S:' . $this->ssid . $this->separator;
        if (isset($this->password)) $wifi .= 'P:' . $this->password . $this->separator;
        if (isset($this->hidden)) $wifi .= 'H:' . $this->hidden . $this->separator;

        return $wifi;
    }


    private function setProperties(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");

        $text = $arguments[0];
        if (isset($text['encryption'])) $this->encryption = $text['encryption'];
        if (isset($text['ssid'])) $this->ssid = $text['ssid'];
        if (isset($text['password'])) $this->password = $text['password'];
        if (isset($text['hidden'])) $this->hidden = $text['hidden'];
    }
}