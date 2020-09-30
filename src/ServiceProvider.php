<?php

namespace AfromanSR\LaravelMathCaptcha;

use Illuminate\Support\Facades\Validator;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        Validator::extend('math_captcha', function($attribute, $value, $parameters)
        {
            return $value == MathCaptcha::getAnswer();
        },'Invalid captcha answer');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/captcha.php','captcha'
        );
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/captcha.php' => config_path('captcha.php')
        ], 'captcha-config');
    }
}