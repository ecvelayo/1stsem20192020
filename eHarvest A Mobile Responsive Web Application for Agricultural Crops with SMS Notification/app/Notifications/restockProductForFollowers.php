<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
class restockProductForFollowers extends Notification
{
    use Queueable;
    protected $supply;
    protected $nexmoMessage;
    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($supply)
    {
        $this->supply = $supply;
        $this->message = "Product ".$supply->products['product_name'] ." which you are following, has just been restocked with a quantity of "
        .$supply->actual_quantity." ".$supply->products->unit['name']." and a Price of P" .$supply->products['price']. ".";

        $this->nexmoMessage = "Product ".$supply->products['product_name'] ." which you are following, has just been restocked with a quantity of "
        .$supply->actual_quantity." ".$supply->products->unit['name']." and a Price of P" .$supply->products['price']. ". Shop now at eharvest.ph";
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
            'nexmoMessage'=>$this->nexmoMessage,
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
                    ->content($this->nexmoMessage); 
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
