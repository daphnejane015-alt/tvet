<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

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
        $verificationUrl = $notifiable->getEmailVerificationUrl();

        return (new MailMessage)
            ->subject('Sahkan Emel Anda - AceTVET')
            ->greeting('Salam Sejahtera ' . $notifiable->name . ',')
            ->line('Terima kasih kerana mendaftar akaun AceTVET.')
            ->line('Sila klik butang di bawah untuk mengesahkan alamat emel anda dan mengaktifkan akaun.')
            ->line('Pautan pengesahan ini akan tamat tempoh dalam 60 minit.')
            ->action('Sahkan Emel', $verificationUrl)
            ->line('Jika anda tidak mendaftar akaun AceTVET, sila abaikan emel ini.')
            ->salutation('Terima kasih,')
            ->line('Pasukan AceTVET');
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
