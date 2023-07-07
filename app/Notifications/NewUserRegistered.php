<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewUserRegistered extends Notification
{
    use Queueable;
    
    protected $user;
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

        $subject = 'New User Registration';
        $body = "A new user has registered on your application.\n\n";
        $body .= "User Details:\n";
        $body .= "- Name: {$this->user->name}\n";
        $body .= "- Email: {$this->user->email}\n";
        $body .= "- Role: {$this->user->roles()->pluck('name')->first()}\n";

        return (new MailMessage)
                ->subject($subject)
                ->line(new HtmlString($body))
                ->salutation('Regards');
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
