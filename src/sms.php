<?php

namespace HirbodKhatami\SmsPackage;

use Illuminate\Support\Facades\Http;

class sms
{
    protected string $to;
    protected string $text;

    public function __construct()
    {
    }

    public function to()
    {
        $this->to = $to;

        return $this;
    }

    public function text()
    {
        $this->text = $text;

        return $this;
    }

    public function send()
    {
        $headers =
        [
            "Accept" => "application/json, text-plain, */*",
            'content-type' => 'application/json',
            'postman-token' => '3e37c158-2c35-75aa-1ae7-f76d90ebbe8f',
            'cache-control' => 'no-cache'
        ];

        $data =
        [
            'username' => config("SMS_USERNAME"),
            'password' => config("SMS_PASSWORD"),
            'to' => $this->to,
            'from' => config("SMS_from"),
            'text' => $this->text,
            'isflash' => 'false'
        ];

        $response = Http::withHeaders($headers)->post(config('SMS_HOST'), $data);

        return $this;
    }

    public function build()
    {
        return $this;
    }
}
