<?php

namespace HirbodKhatami\SmsPackage;

use Illuminate\Support\ServiceProvider;

use Illuminate\Notifications\ChannelManager;

use Illuminate\Support\Facades\Notification;

use HirbodKhatami\SmsPackage\Channels\SmsChannel;

use HirbodKhatami\SmsPackage\Console\InstallSmsPackage;
use HirbodKhatami\SmsPackage\Console\Make\MakeSmsableCommand;

class SmsPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('sms', function ($app) {
                return new SmsChannel;
            });
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'smspackage');

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [__DIR__ . '/../config/config.php' => config_path('sms.php')],
                'config'
            );

            $this->commands([
                InstallSmsPackage::class,
                MakeSmsableCommand::class
            ]);
        }
    }

    public function boot()
    {
        //
    }
}
