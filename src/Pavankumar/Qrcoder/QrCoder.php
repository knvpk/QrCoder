<?php namespace Pavankumar\Qrcoder;

include('phpqrcode/qrlib.php');
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Pavankumar\Qrcoder\Exceptions\InvalidFormatException;
use PhpSpec\Exception\Exception;

class QrCoder
{
    protected $qr;
    protected $format = 'svg';
    protected $destination = false;
    protected $supportedFormats = ['svg', 'canvas', 'png', 'text', 'eps', 'raw'];
    protected $errorCorrection = QR_ECLEVEL_M;
    protected $size = 8;
    protected $frame = 3;
    protected $color = 0x000000;
    protected $backColor = 0xFFFFFF;

    protected $errorCorrections = [
        'L' => 'QR_ECLEVEL_L',
        'M' => 'QR_ECLEVEL_M',
        'Q' => 'QR_ECLEVEL_Q',
        'H' => 'QR_ECLEVEL_H'
    ];

    function __construct()
    {
        $this->qr = new \QRcode();
    }


    public function setFormat($format)
    {
        $format = strtolower($format);
        if (in_array($format, $this->supportedFormats)) {
            $this->format = $format;
            return $this;
        } else {
            throw new InvalidFormatException('Invalid format provided.');
        }
    }


    public function setErrorCorrection($level)
    {
        if (array_key_exists($level, $this->errorCorrections)) {
            $this->errorCorrection = $this->errorCorrections[$level];
        } else {
            throw new Exception('Invalid ErrorCorrection value supported is L,M,Q,H');
        }

        return $this;
    }

    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    public function setFrame($frame)
    {
        $this->frame = $frame;
        return $this;
    }

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function setBackColor($BColor)
    {
        $this->backColor = $BColor;
        return $this;
    }

    public function setDestination($filePath)
    {
        if (file_exists($filePath))
            throw new InvalidArgumentException("File already exists");
        fopen($filePath, 'w');
        $this->destination = $filePath;
        return $this;
    }


    public function generate($text)
    {
        return $this->generateWithFormat($text, $this->destination, $this->errorCorrection, $this->size, $this->frame, $this->backColor, $this->color);

    }

    protected function generateWithFormat($text, $filePath, $errorCorrection, $pixel, $frame, $backColor, $color)
    {
        switch ($this->format) {
            case 'png':
                return $this->qr->png($text, $filePath, $errorCorrection, $pixel, $frame, false, $backColor, $color);
                break;
            case 'svg':
                return $this->qr->svg($text, $filePath, $errorCorrection, $pixel, $frame, false, $backColor, $color);
                break;
            case 'eps':
                return $this->qr->eps($text, $filePath, $errorCorrection, $pixel, $frame, false, $backColor, $color);
                break;
            case 'canvas':
                return $this->qr->canvas($text, $filePath, $errorCorrection, $pixel, $frame, false, $backColor, $color);
                break;
            case 'text':
                return $this->qr->text($text, $filePath, $errorCorrection, $pixel, $frame);
                break;
            case 'raw':
                return $this->qr->raw($text, $filePath, $errorCorrection, $pixel, $frame);
                break;
            default:
                throw new InvalidFormatException('Invalid format provided.');
        }
    }


    public function __call($method, $arguments)
    {
        $dataType = $this->createClass($method);

        $dataType->create($arguments);


        return $this->generate(strval($dataType));
    }

    private function createClass($method)
    {
        $class = 'Pavankumar\Qrcoder\DataTypes\\' . ucfirst(strtolower($method));

        if (!class_exists($class)) throw new \BadMethodCallException;

        return new $class;
    }


}