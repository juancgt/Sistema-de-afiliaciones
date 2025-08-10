<?php

namespace Dist\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

use Illuminate\Support\Facades\Lang;

class CambiarPassword extends ResetPasswordNotification
{
    use Queueable;
    public $token;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    /*->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');*/
                    ->subject(Lang::getFromJson('Solicitud de Cambio de Contraseña'))
                    ->line(Lang::getFromJson('Estás recibiendo este email porque has solicitado cambiar la contraseña.'))
                    ->action(Lang::getFromJson('Cambiar Contraseña'), url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
                    ->line(Lang::getFromJson('Este enlace caducará en :count minutes.', ['count' => config('auth.passwords.users.expire')]))
                    ->line(Lang::getFromJson('Si no has solicitado el cambio de contraseña, no tienes que hacer nada.'));

                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
