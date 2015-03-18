<?php namespace Pavankumar\Qrcoder\DataTypes;


class WiFi implements DataTypeInterface
{


    private $prefix = 'WIFI:';

    private $separator = ';';

    private $encryption;

    private $ssid;

    private $password;

    private $hidden;

    public function create(Array $arguments)
    {
        $this->setProperties($arguments);
    }

    public function __toString()
    {
        return $this->buildWifiString();
    }

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