<?php

namespace HirbodKhatami\SmsPackage\Channels;

use BadMethodCallException;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification): void
    {
        if (!method_exists($notification, $method = 'toSms')) {
            throw new BadMethodCallException('The method \'toSms\' does not exist in the current notification object.', 500);
        }

        $notification->{$method}($notifiable)->build()->send();
    }
}
