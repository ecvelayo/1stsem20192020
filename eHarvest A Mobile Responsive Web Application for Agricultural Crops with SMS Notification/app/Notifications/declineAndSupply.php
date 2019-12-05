<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\NexmoMessage;

class declineAndSupply extends Notification
{
    use Queueable;
    protected $supply;
    protected $reason;
    protected $message;
    protected $nexmoMessage;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($supply,$reason)
    {
        $this->supply = $supply;
        $this->reason = $reason;
        $this->message = "Your Supply request has been declined. Reason: ".$reason."";
        $this->nexmoMessage = "Your Supply request has been declined. Reason: ".$reason.". This is an automated message from eharvest.ph";
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
