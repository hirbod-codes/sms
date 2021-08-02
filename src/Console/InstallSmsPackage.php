<?php

namespace HirbodKhatami\SmsPackage\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallSmsPackage extends Command
{
    protected $signature = 'smspackage:install';

    protected $description = 'Install the SmsPackage';

    public function handle()
    {
        $this->info('Installing SmsPackage...');

        $this->info('Publishing configuration...');

        if (!$this->configExists('smspackage.php')) 
        {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } 
        else 
        {
            if ($this->shouldOverwriteConfig()) 
            {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } 
            else 
            {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('SmsPackage has been instaled.');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "HirbodKhatami\SmsPackage\SmsPackageServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }
}