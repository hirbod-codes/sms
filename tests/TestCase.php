<?php

namespace HirbodKhatami\SmsPackage\Tests;

use HirbodKhatami\SmsPackage\SmsPackageServiceProvider;

use \Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return 
        [
            SmsPackageServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}