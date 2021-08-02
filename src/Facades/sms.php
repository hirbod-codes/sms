<?php

namespace HirbodKhatami\SmsPackage\Facades;

use Illuminate\Support\Facades\Facade;

class sms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sms';
    }
}