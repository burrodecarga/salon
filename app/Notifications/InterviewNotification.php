<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Carbon\Carbon;
use App\Models\Interview;

class InterviewNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Interview $interview)
    {
        $this->interview = $interview;//
    }

    public Interview $interview;
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'teacher' => $this->interview->teacher,
            'student' => $this->interview->student_,
            'teacher_id' => $this->interview->teacher_id,
            'student_id' => $this->interview->student__id,
            'aula_id' => $this->interview->aula__id,
            'fecha' => Carbon::now(),
            'time' => Carbon::now()->diffForHumans()   //
        ];
    }
}
