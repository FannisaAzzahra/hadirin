<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification; // Pastikan ini tetap ada
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordParent;

class ResetPasswordNotification extends ResetPasswordParent
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        parent::__construct($token);
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(mixed $notifiable): array // UBAH 'object' menjadi 'mixed' di sini
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        // ... kode toMail Anda yang sudah benar ...
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $expireMinutes = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

        return (new MailMessage)
                    ->subject('Reset Kata Sandi Anda')
                    ->greeting('Halo!')
                    ->line('Anda menerima email ini karena kami menerima permintaan reset kata sandi untuk akun Anda.')
                    ->action('Reset Kata Sandi', $url)
                    ->line('Tautan reset kata sandi ini akan kedaluwarsa dalam ' . $expireMinutes . ' menit.')
                    ->line('Jika Anda tidak meminta reset kata sandi, tidak ada tindakan lebih lanjut yang diperlukan.')
                    ->salutation('Hormat kami,' . "\n" . config('app.name'));
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