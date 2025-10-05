<?php

namespace App\Repositories;

use App\Contracts\Repositories\RevenueIngredientRepositoryInterface;
use App\Models\RevenueIngredient;

class RevenueIngredientRepository implements RevenueIngredientRepositoryInterface
{
    public function __construct(protected RevenueIngredient $model) {}

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
        $ingredient = $this->findById($id);

        if ($ingredient) {
            return $ingredient->delete();
        }

        return false;
    }

    public function deleteByRevenue(int $revenueID): void
    {
        $this->model->where('revenue_id', $revenueID)->delete();
    }
}
