# sms
A basic laravel package to send SMS messages through third party APIs.

Run: php artisan smspackage:install
It will make a new config file called 'smspackage.php' in config directory, if haven't got any.

Then run php artisan make:notification ExampleSms

Then in ExampleSms define a method named 'toSms'
    that returns an inatance of HirbodKhatami\SmsPackage\Sms class.

Don't forget to use 'text' and 'to' public methods of Sms class(this is required).
