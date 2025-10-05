<?php

namespace App\Contracts\Repositories;

interface RevenueIngredientRepositoryInterface
{
    public function findById($id);

    public function create(array $data);

    public function delete($id);

    public function deleteByRevenue(int $revenueID): void;
}
