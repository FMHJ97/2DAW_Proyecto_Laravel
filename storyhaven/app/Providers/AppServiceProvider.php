<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Personalización del correo de verificación
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
            ->subject('¡Tu aventura en StoryHaven comienza aquí!')
            ->greeting('¡Hola narrador!')
            ->line('¡Gracias por unirte a StoryHaven, el hogar de historias extraordinarias!')
            ->line('Para comenzar a explorar mundos literarios y compartir tus propias historias, necesitamos verificar tu dirección de correo electrónico.')
            ->action('Verificar mi email', $url)
            ->line('Una vez verificado, podrás crear, compartir y descubrir historias fascinantes.')
            ->line('Si no creaste una cuenta en StoryHaven, simplemente ignora este mensaje.')
            ->salutation('¡Esperamos leer tus historias pronto!');
        });

        // Personalización del correo de restauración de contraseña
        ResetPassword::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Recupera el acceso a tu mundo de historias en StoryHaven')
                ->greeting('¡Hola narrador!')
                ->line('Recibimos una solicitud para restablecer la contraseña de tu cuenta en StoryHaven.')
                ->line('Este enlace te permitirá crear una nueva contraseña y recuperar el acceso a tus historias.')
                ->action('Restablecer contraseña', $url)
                ->line('Este enlace de restablecimiento caducará en 60 minutos.')
                ->line('Si no solicitaste cambiar tu contraseña, no es necesario realizar ninguna acción.')
                ->line('Tu cuenta y tus historias están seguras.')
                ->salutation('¡Esperamos verte de vuelta pronto en StoryHaven!');
        });
    }
}
