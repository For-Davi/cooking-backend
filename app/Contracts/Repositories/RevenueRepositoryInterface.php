<?php

namespace App\Contracts\Repositories;

use App\DTO\Revenue\UpdateRevenueImageDTO;

interface RevenueRepositoryInterface
{
    public function getAllByUser($relations);

    public function findById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function updateImage(int $revenueID, UpdateRevenueImageDTO $dto): ?object;
}
