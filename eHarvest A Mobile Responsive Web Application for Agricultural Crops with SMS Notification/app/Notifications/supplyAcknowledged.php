<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
class supplyAcknowledged extends Notification
{
    use Queueable;
    protected $supply;
    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($supply)
    {
        $this->supply = $supply;
        $this->message = "Your restock query has been acknowledged! Please deliver the items not later than " 
        .$supply->expected_delivery_date. " so that your query will not be cancelled. Thank you!";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','nexmo'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'supply'=>$this->supply,
            'user'=>$notifiable,
            'message'=>$this->message,
        ];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content($this->message); 
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
