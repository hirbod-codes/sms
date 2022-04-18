<?php

namespace HirbodKhatami\SmsPackage\Tests;

use HirbodKhatami\SmsPackage\SmsPackageServiceProvider;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends FrameworkTestCase
{
    public function setUp(): void
    {
        parent::setUp();
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
