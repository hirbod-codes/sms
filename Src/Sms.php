<?php

namespace HirbodKhatami\SmsPackage;

use HirbodKhatami\SmsPackage\Exceptions\SmsNotSentException;
use Illuminate\Support\Facades\Http;

class Sms
{
    protected string $to;

    protected string $text;

    public function to(string $to): static
    {
        $this->to = $to;

        return $this;
    }

    public function text(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function send(): static
    {
        $headers =
            [
                "Accept" => "*/*",
                'content-type' => 'application/json',
                'cache-control' => 'no-cache'
            ];

        $data =
            [
                'username' => config("smspackage.SMS_USERNAME"),
                'password' => config("smspackage.SMS_PASSWORD"),
                'to' => $this->to,
                'from' => config("smspackage.SMS_from"),
                'text' => $this->text,
                'isflash' => 'false'
            ];

        $response = Http::withHeaders($headers)->post(config('smspackage.SMS_HOST'), $data);

        if (($code = json_decode($response->body(), true)["RetStatus"]) !== 1) {
            throw new SmsNotSentException($response->body(), $code);
        }

        return $this;
    }

    public function build(): static
    {
        return $this;
    }
}
