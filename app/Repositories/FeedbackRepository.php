<?php

namespace App\Repositories;

use App\Models\Feedback;

class FeedbackRepository
{
    public function __construct(protected Feedback $model) {}

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
