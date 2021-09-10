<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionWarning7DaysAfter extends Notification
{
    use Queueable;
    public $item;
    public $contestsCount;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($item,$contestsCount)
    {
        $this->item = $item;
        $this->contestsCount = $contestsCount;
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
        return (new MailMessage)->markdown('mail.subscriptions_7_days_after',['item' => $this->item, 'contestsCount' => $this->contestsCount])->subject('A sua subscrição expirou à 7 dias');
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
