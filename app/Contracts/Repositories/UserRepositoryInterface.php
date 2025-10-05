<?php

namespace App\Contracts\Repositories;

interface UserRepositoryInterface
{
    public function findById(int $id);

    public function findByEmail(string $email);

    public function create(array $data);

    public function update(int $id, array $data);

    public function updatePassword(int $id, array $data);

    public function newPassword(string $email, array $data);

    public function delete(int $id);
}
