<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(public User $model) {}

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        if ($user) {
            $user->update($data);

            return $user;
        }

        return null;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function updatePassword($id, array $data)
    {
        $user = $this->findById($id);
        if ($user) {
            $user->update($data);

            return $user;
        }

        return null;
    }

    public function newPassword($email, array $data)
    {
        $user = $this->findByEmail($email);
        if ($user) {
            $user->update($data);

            return $user;
        }

        return null;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        if ($user) {
            return $user->delete();
        }

        return false;
    }
}
