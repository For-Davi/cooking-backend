<?php

namespace App\Repositories;

use App\Models\Product;

class ProductMovementRepository
{
    public function __construct(protected Product $model) {}

    public function getAllByEnterprise($enterpriseId, $relations = null)
    {
        $query = $this->model->where('enterprise_id', $enterpriseId);

        if ($relations) {
            $query->with($relations);
        }

        return $query->get();
    }

    public function findById($id, $relations = null)
    {
        $query = $this->model;

        if ($relations) {
            $query = $query->with($relations);
        }

        return $query->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $movement = $this->findById($id);
        if ($movement) {
            $movement->update($data);

            return $movement;
        }

        return null;
    }

    public function delete($id)
    {
        $movement = $this->findById($id);
        if ($movement) {
            return $movement->delete();
        }

        return false;
    }
}
