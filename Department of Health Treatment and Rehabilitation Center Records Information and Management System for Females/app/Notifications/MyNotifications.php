<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MyNotifications extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user) 
    {
        $this->user = $user;
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
    public function toDatabase($notifiable)
    {
        if($this->user->department != 0){
            $depart = $this->user->user_departments->department_name;
        }
        else{
            $depart = "none";
        }
        return [
            'user_id' => $this->user->id,
            'fname' => $this->user->fname,
            'lname' => $this->user->lname,
            'department' => $depart,
            'role' => $this->user->user_roles->name,
        ];
    }
}
