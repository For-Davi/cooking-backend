<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    public function __construct(protected Image $model) {}

    public function getAllByEnterprise($enterpriseId)
    {
        return $this->model->where('enterprise_id', $enterpriseId)->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $image = $this->findById($id);
        if ($image) {
            $image->update($data);

            return $image;
        }

        return null;
    }

    public function delete($id)
    {
        $image = $this->findById($id);

        if ($image) {
            DB::table('product_image')->where('image_id', $image->id)->delete();

            return $image->delete();
        }

        return false;
    }
}
