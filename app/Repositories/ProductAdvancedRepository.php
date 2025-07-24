<?php

namespace App\Repositories;

use App\Models\ProductAdvanced;

class ProductAdvancedRepository
{
    public function __construct(protected ProductAdvanced $model) {}

    public function getAll()
    {
        return $this->model->all();
    }

    public function findByProductID($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->findByProductID($id);
        if ($product) {
            $product->update($data);

            return $product;
        }

        return null;
    }
}
