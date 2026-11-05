<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(public $token)
    {
        //
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
            ->subject('Tetapan Semula Kata Laluan - AceTVET')
            ->greeting('Salam Sejahtera ' . $notifiable->name . ',')
            ->line('Anda menerima emel ini kerana kami menerima permintaan untuk menetapkan semula kata laluan akaun AceTVET anda.')
            ->line('Jika ini bukan permintaan anda, sila abaikan emel ini.')
            ->action('Tetapkan Kata Laluan', url(config('app.url') . route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line('Pautan ini akan tamat tempoh dalam 60 minit.')
            ->line('Sekiranya anda mempunyai sebarang pertanyaan, sila hubungi kami.')
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
