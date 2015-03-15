<?php namespace Pavankumar\Qrcoder\DataTypes;

use BaconQrCode\Exception\InvalidArgumentException;

/**
 * Simple Laravel QrCode Generator
 * A simple wrapper for the popular BaconQrCode made for Laravel.
 *
 * @link http://www.simplesoftware.io
 * @author SimpleSoftware support@simplesoftware.io
 *
 */
class Email implements DataTypeInterface
{

    /**
     * The prefix of the QrCode
     *
     * @var string
     */
    private $prefix = 'mailto:';

    /**
     * The email address
     *
     * @var string
     */
    private $email;

    /**
     * The subject of the email
     *
     * @var string
     */
    private $subject;

    /**
     * The body of an email.
     *
     * @var string
     */
    private $body;

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
        return $this->buildEmailString();
    }

    /*
     * Builds the email string.
     *
     * @return string
     */
    private function buildEmailString()
    {
        if (strlen($this->email) == 0) {
            $email = $this->prefix . '""';

        } else {
            $email = $this->prefix . $this->email;

        }

        if (isset($this->subject) || isset($this->body)) {
            $data = [
                'subject' => $this->subject,
                'body' => $this->body
            ];
            $email .= '?' . http_build_query($data);
        }



        return $email;
    }


    private function setProperties(Array $arguments)
    {
        if (!isset($arguments[0]))
            throw new \Exception("Data not provided");


        $text = $arguments[0];

        if (array_key_exists('address', $text)) $this->setEmail($text["address"]);

        if (array_key_exists('subject', $text)) $this->subject = $text["subject"];
        if (array_key_exists('body', $text)) $this->body = $text["body"];


    }


    private function setEmail($email)
    {
        if (strlen($email) == 0) {
            $this->email = " ";
            return;
        }
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