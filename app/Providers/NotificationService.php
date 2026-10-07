<?php

namespace App\Providers;

use App\Models\Notification;

class NotificationService
{
    public static function create(
        ?int $userId,
        string $title,
        string $message,
        ?string $type = null,
        ?string $actionUrl = null
    ): Notification {
        return Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'action_url' => $actionUrl,
            'is_read' => false,
        ]);
    }
}