<?php namespace Pavankumar\Qrcoder;


use Illuminate\Support\ServiceProvider;

class QrCoderServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('PavanKumar\QrCoder\QrCoder', function () {
            return new QrCoder;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('qrcoder');
    }

}
