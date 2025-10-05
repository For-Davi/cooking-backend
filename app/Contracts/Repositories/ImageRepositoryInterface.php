<?php

namespace App\Contracts\Repositories;

interface ImageRepositoryInterface
{
    public function findById(int $id);

    public function create(array $data);

    public function delete(int $id);
}
