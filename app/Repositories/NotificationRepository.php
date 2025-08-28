<?php

namespace App\Repositories;

use App\DTO\User\FilterUserDTO;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class NotificationRepository
{
    public function __construct(public Notification $model) {}

    public function getAllByUserId($userID, array $relations = [])
    {
        $query = $this->model->where('user_id', $userID);

        if (! empty($relations)) {
            $query->with($relations);
        }

        return $query->get();
    }
}