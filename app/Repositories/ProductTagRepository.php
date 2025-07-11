<?php

namespace App\Repositories;

use App\Models\ProductTag;

class ProductTagRepository
{
    public function __construct(protected ProductTag $model) {}

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllByEnterprise($enterpriseId)
    {
        return $this->model->where('enterprise_id', $enterpriseId)->get();
    }

    public function getAllByProductID($productServiceID)
    {
        return $this->model->where('product_service_id', $productServiceID)->get();
    }

    public function getAllByTagID($tagID)
    {
        return $this->model->where('tag_id', $tagID)->get();
    }

    public function getAllByProductAndTag($productServiceID, $tagID)
    {
        return $this->model
            ->where('product_service_id', $productServiceID)
            ->where('tag_id', $tagID)
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

    public function update($id, array $data)
    {
        $productTag = $this->findById($id);
        if ($productTag) {
            $productTag->update($data);

            return $productTag;
        }

        return null;
    }

    public function deleteByProductID($productServiceID)
    {
        return $this->model
            ->where('product_service_id', $productServiceID)
            ->delete();
    }

    public function deleteByTagID($tagID)
    {
        return $this->model
            ->where('tag_id', $tagID)
            ->delete();
    }

    public function deleteByProductAndTag($productServiceID, $tagID)
    {
        return $this->model
            ->where('product_service_id', $productServiceID)
            ->where('tag_id', $tagID)
            ->delete();
    }
}
