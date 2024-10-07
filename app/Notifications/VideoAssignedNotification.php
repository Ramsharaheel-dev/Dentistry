<?php

namespace App\Notifications;

use App\Models\Podcast;
use App\Models\Reel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VideoAssignedNotification extends Notification
{
    use Queueable;
    public $assignment;

    /**
     * Create a new notification instance.
     */
    public function __construct($assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    // /**
    //  * Get the mail representation of the notification.
    //  */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @return array<string, mixed>
    //  */
    public function toArray($notifiable)
    {
        if ($this->assignment->video_type == 'reel') {
            $videoTitle = Reel::where('id', $this->assignment->video_id)->first();
            $url = 'dashboard/';
        } elseif ($this->assignment->video_type == 'podcast') {
            $videoTitle = Podcast::where('id', $this->assignment->video_id)->first();
            $url = 'podcast/';
        }
        $userName = User::where('id', $this->assignment->assigned_uid)->first();

        return [
            'title' => 'New Video Assigned',
            'name' => $userName ? $userName->name : null,
            'video_title' => $videoTitle ? $videoTitle->name : null,
            'end_date' => $this->assignment->end_date,
            'end_time' => $this->assignment->end_time,
            'deadline' => $this->assignment->end_date . ' ' . $this->assignment->end_time,
            'url' => $url . $this->assignment->video_id,
            'assigned_by' => $this->assignment->assigned_by
        ];
    }
}
