<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MyFourthNotifications extends Notification
{
    use Queueable;

    public $graduate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($graduate)
    {
        $this->graduate = $graduate;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'graduate_id' => $this->graduate->graduate_id,
            'in_department' => $this->graduate->graduate_departments->department_name,
            'patient_id' => $this->graduate->patient_id,
            'remarks' => $this->graduate->remarks,
        ];
    }
}
