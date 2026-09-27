<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $token
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url(
            route(
                'password.reset',
                [
                    'token' => $this->token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ],
                false
            )
        );

        $expire = Config::get(
            'auth.passwords.' .
            Config::get('auth.defaults.passwords') .
            '.expire'
        );

        return (new MailMessage)
            ->subject('Restablecer contraseña - Sistema de Gestión')
            ->view(
                'emails.reset-password',
                [
                    'titulo' =>
                        'Restablecer contraseña',

                    'nombre' =>
                        $notifiable->name,

                    'url' =>
                        $url,

                    'expire' =>
                        $expire,
                ]
            );
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}