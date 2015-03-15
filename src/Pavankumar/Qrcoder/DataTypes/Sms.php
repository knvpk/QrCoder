<?php namespace Pavankumar\Qrcoder\DataTypes;


class SMS implements DataTypeInterface
{


    private $prefix = 'sms:';

    private $separator = ':';

    private $phoneNumber;

    private $message;

    public function create(Array $arguments)
    {
        $this->setProperties($arguments);
    }

    public function __toString()
    {
        return $this->buildSMSString();
    }

    private function setProperties(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");

        $text = $arguments[0];
        if (array_key_exists('number', $text)) $this->phoneNumber = $text['number'];
        if (array_key_exists('message', $text)) $this->message = $text['message'];
    }

    private function buildSMSString()
    {
        $sms = $this->prefix . $this->phoneNumber;

        if (isset($this->message)) {
            $sms .= $this->separator . $this->message;
        }

        return $sms;
    }
}