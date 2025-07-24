<?php

namespace App\Repositories;

use App\Models\ProductImage;

class ProductImageRepository
{
    public function __construct(protected ProductImage $model) {}

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllByProductID($productID)
    {
        return $this->model->where('product_id', $productID)->get();
    }

    public function getAllByImageID($imageID)
    {
        return $this->model->where('image_id', $imageID)->get();
    }

    public function getAllByProductAndImage($productID, $imageID)
    {
        return $this->model
            ->where('product_id', $productID)
            ->where('image_id', $imageID)
            ->first();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function deleteByProductID($productID)
    {
        return $this->model
            ->where('product_id', $productID)
            ->delete();
    }

    public function deleteByTagID($imageID)
    {
        return $this->model
            ->where('image_id', $imageID)
            ->delete();
    }

    public function deleteByProductAndImage($productID, $imageID)
    {
        return $this->model
            ->where('product_id', $productID)
            ->where('image_id', $imageID)
            ->delete();
    }
}
