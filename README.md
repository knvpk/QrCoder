# QrCoder
This is Laravel5 Pacakage built on top of [phpqrcode](https://github.com/t0k4rt/phpqrcode) for generating Qrcodes with different formats and helper functions to make programming dead easy.

>Almost the package is finished.

### Introduction
    QrCoder is an simple wrapper around the [phpqrcode](https://github.com/t0k4rt/phpqrcode) for generating 2-D QrCodes
    that support Laravel-5.
    
### Supported Formats
    1. Png
    2. svg (default)
    3. text
    4. raw
    5. eps
    6. canvas (comming soon ....)
    
### Available configurations
    1. Fore color and background color.
    2. Pixel size.
    3. Margin.
    4. Error correction level.
    5. Format (svg,png,text,raw,eps and canvas).
##Installation
### Using Composer(recommended)
First add the below lines to your `require` to your `composer.json`.
    require:{
    "pavankumar/qrcoder":"dev"
    }
Next, run the `composer update` command.

    
    
