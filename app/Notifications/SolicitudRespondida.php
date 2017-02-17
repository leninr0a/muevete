<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SolicitudRespondida extends Notification
{
    use Queueable;
    protected $respuesta;
    protected $viaje;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($viaje,$respuesta)
    {
        $this->viaje = $viaje;
        $this->respuesta = $respuesta;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable){
        if($this->respuesta == true){
            $message = $this->viaje->user->nombre." ".$this->viaje->user->apellido." ha aceptado tu solicitud en el viaje de ".$this->viaje->salida." a ".$this->viaje->llegada;
        }else{
            $message = $this->viaje->user->nombre." ".$this->viaje->user->apellido." ha rechazado tu solicitud en el viaje de ".$this->viaje->salida." a ".$this->viaje->llegada.". Ve otras opciones haciendo clic aqui.";
        }


        return [
            "sender"    => $this->viaje->user,
            "message"   => $message
        ];

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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
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
