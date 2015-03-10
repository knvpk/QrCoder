<?php namespace Pavankumar\Qrcoder;

include('phpqrcode/qrlib.php');
use Pavankumar\Qrcoder\Exceptions\InvalidFormatException;
use PhpSpec\Exception\Exception;

class QrCoder
{
    protected $qr;
    protected $format = 'svg';
    protected $destination = false;
    protected $filename;
    protected $supportedFormats = ['svg', 'canvas', 'png', 'text', 'eps', 'raw'];
    protected $errorCorrection = QR_ECLEVEL_M;
    protected $size = 8;
    protected $frame = 3;
    protected $color = 0xFFFFFF;
    protected $backColor = 0x000000;

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

    public function setTo($destination, $filename)
    {
        if (is_dir($destination))
            $this->destination = $destination;
        else {
            throw new \InvalidArgumentException('Dir not found');
        }

        $this->filename = $filename;
        return $this;
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


    public function generate($text)
    {
        return $this->generateWithFormat($text, $this->getFullpath(), $this->errorCorrection, $this->size, $this->frame, $this->color, $this->backColor);

    }

    protected function generateWithFormat($text, $filepath, $errorCorrection, $pixel, $frame, $backColor, $color)
    {
        switch ($this->format) {
            case 'png':
                return $this->qr->png($text, $filepath, $errorCorrection, $pixel, $frame, false, $color, $backColor);
                break;
            case 'svg':
                return $this->qr->svg($text, $filepath, $errorCorrection, $pixel, $frame, false, $color, $backColor);
                break;
            case 'eps':
                return $this->qr->eps($text, $filepath, $errorCorrection, $pixel, $frame, false, $color, $backColor);
                break;
            case 'canvas':
                return $this->qr->canvas($text, $filepath, $errorCorrection, $pixel, $frame, false, $backColor, $color);
                break;
            case 'text':
                return $this->qr->text($text, $filepath, $errorCorrection, $pixel, $frame);
                break;
            case 'raw':
                return $this->qr->raw($text, $filepath, $errorCorrection, $pixel, $frame);
                break;
            default:
                throw new InvalidFormatException('Invalid format provided.');
        }
    }

    protected function getFullpath()
    {
//        return $this->destination . $this->filename . '.' . $this->format;
        return false;
    }


}