<?php

namespace App\Contracts\Repositories;

interface CategoryRepositoryInterface
{
    public function getAllByUser();

    public function findById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
