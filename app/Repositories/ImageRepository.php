<?php

namespace App\Repositories;

use App\Contracts\Repositories\ImageRepositoryInterface;
use App\Models\Image;

class ImageRepository implements ImageRepositoryInterface
{
    public function __construct(protected Image $model) {}

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function delete($id)
    {
        $image = $this->findById($id);

        if ($image) {
            return $image->delete();
        }

        return false;
    }
}
