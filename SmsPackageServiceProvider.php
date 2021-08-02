<?php

namespace HirbodKhatami\SmsPackage;

use Illuminate\Support\ServiceProvider;

use Illuminate\Notifications\ChannelManager;

use Illuminate\Support\Facades\Notification;

use HirbodKhatami\SmsPackage\sms;

use HirbodKhatami\SmsPackage\Channels\SmsChannels;

use HirbodKhatami\SmsPackage\Console\InstallSmsPackage;
use HirbodKhatami\SmsPackage\Console\Make\MakeSmsableCommand;

class SmsPackageServiceProvider extends ServiceProvider
{
    public $singletons = [
        'smspackage' => SmsChannels::class,
    ];

    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('smspackage', function ($app) {
                return $app->make('smspackage');
            });
        });
        
        $this->app->bind('sms', function($app) {
            return new sms();
        });
        
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'smspackage');
        
        if ($this->app->runningInConsole()) 
        {
            $this->publishes(
                [
                    __DIR__.'/../config/config.php' => config_path('smspackage.php'),
                ], 'config');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallSmsPackage::class,
                MakeSmsablCommand::class
            ]);
        }
    }

    public function boot()
    {
        //
    }
}
