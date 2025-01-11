<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgatPasswordNotification extends Notification
{
    use Queueable;
    private $email;
    private $otp;
    /**
     * Create a new notification instance.
     */
    public function __construct($otp)
    {
        // $this->email = $email;
        $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->mailer(env('MAIL_MAILER'))
                ->from(env('MAIL_FROM_ADDRESS'))
                ->subject('Password Ressting')
                ->line('Use the below code for reseting your password')
                ->line('Code: ' . $this->otp);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
