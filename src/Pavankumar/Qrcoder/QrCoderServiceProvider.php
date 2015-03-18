<?php namespace Pavankumar\Qrcoder;


use Illuminate\Support\ServiceProvider;

class QrCoderServiceProvider extends ServiceProvider
{


    protected $defer = true;

    public function register()
    {
        $this->app->bindShared('PavanKumar\QrCoder\QrCoder', function () {
            return new QrCoder;
        });
    }

    public function provides()
    {
        return array('qrcoder');
    }

}
