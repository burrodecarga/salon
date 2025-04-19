<?php

namespace App\Listeners;

use App\Events\InterviewEvent;
use App\Notifications\InterviewNotification;
use App\Notifications\SolicitarIntervencion;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Teacher;
use Illuminate\Support\Facades\Notification;

class InteviewListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InterviewEvent $event): void
    {
        //$teacher = Teacher::find($event->interview->teacher_id);
        var_dump($event);
        //Notification::send($teacher, new InterviewNotification($event->interview));
    }
}
