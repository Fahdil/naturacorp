<?php

namespace App\Notifications;

use App\Models\Zone;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ZoneAssignedNotification extends Notification
{
    use Queueable;

    protected $zone;

    public function __construct(Zone $zone)
    {
        $this->zone = $zone;
    }

    public function via($notifiable)
    {
        return ['database']; // Notification stockée en base de données
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Une nouvelle zone vous a été attribuée : {$this->zone->code_postal} - {$this->zone->ville}",
            'zone_id' => $this->zone->id,
        ];
    }
}
