<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ManualApprovalNotification extends Notification
{
    use Queueable;

    protected $status;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
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
        if($this->status == 1){
            return (new MailMessage)
            ->subject('Account Approved')
            ->greeting('Hello!')
            ->line('Your account has been manually approved by the administrator.')
            ->line('You can now log in and access your account.')
            ->line('Thank you for your patience and cooperation.')
            ->salutation('Regards');
        }else{
            return (new MailMessage)
            ->subject('Account Rejected')
            ->greeting('Hello!')
            ->line('Your account has been rejected by the administrator.')
            ->line('Thank you for your patience and cooperation.')
            ->salutation('Regards');
        }
        
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
