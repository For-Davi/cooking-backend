<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository
{
    public function __construct(public Notification $model) {}

    public function getAllByUserId($userID, array $relations = [])
    {
        $query = $this->model->where('user_id', $userID);

        if (! empty($relations)) {
            $query->with($relations);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function markAsRead(int $userID, int $notificationID): ?Notification
    {
        $notification = $this->model
            ->where('user_id', $userID)
            ->where('id', $notificationID)
            ->first();

        if ($notification) {
            $notification->update(['read' => 1]);

            return $notification;
        }

        return null;
    }

    public function delete(int $userID, int $notificationID): int
    {
        return $this->model
            ->where('user_id', $userID)
            ->where('id', $notificationID)
            ->delete();
    }
}
