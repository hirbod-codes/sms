<?php

namespace HirbodKhatami\SmsPackage\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

use HirbodKhatami\SmsPackage\Tests\TestCase;

class InstallSmsPackageTest extends TestCase
{
    public function test_the_install_command_copies_the_configuration()
    {
        if (File::exists(config_path('smspackage.php'))) {
            unlink(config_path('smspackage.php'));
        }

        $this->assertFalse(File::exists(config_path('smspackage.php')));

        Artisan::call('smspackage:install');

        $this->assertTrue(File::exists(config_path('smspackage.php')));
    }

    public function test_when_a_config_file_is_present_users_can_choose_to_not_overwrite_it()
    {
        // Given we have already have an existing config file
        File::put(config_path('smspackage.php'), 'test contents');
        $this->assertTrue(File::exists(config_path('smspackage.php')));

        $command = $this->artisan('smspackage:install');

        $command->expectsConfirmation(
            'Config file already exists. Do you want to overwrite it?',
            // When answered with "no"
            'no'
        );

        $command->expectsOutput('Existing configuration was not overwritten');
        $this->assertEquals('test contents', file_get_contents(config_path('smspackage.php')));

        unlink(config_path('smspackage.php'));
    }

    public function test_when_a_config_file_is_present_users_can_choose_to_do_overwrite_it()
    {
        // Given we have already have an existing config file
        File::put(config_path('smspackage.php'), 'test contents');
        $this->assertTrue(File::exists(config_path('smspackage.php')));

        $command = $this->artisan('smspackage:install');

        $command->expectsConfirmation(
            'Config file already exists. Do you want to overwrite it?',
            // When answered with "yes"
            'yes'
        );
        
        // execute the command to force override 
        $command->execute();
        $command->expectsOutput('Overwriting configuration file...');

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../config/config.php'),
            file_get_contents(config_path('smspackage.php'))
        );

        unlink(config_path('smspackage.php'));
    }
}