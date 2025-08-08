<?php

namespace App\Repositories;

use App\Models\TypeAccount;

class TypeAccountRepository
{
    public function __construct(protected TypeAccount $model) {}

    public function getAllByEnterprise($enterpriseId)
    {
        return $this->model->where('enterprise_id', $enterpriseId)->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $type = $this->findById($id);
        if ($type) {
            $type->update($data);

            return $type;
        }

        return null;
    }

    public function delete($id)
    {
        $type = $this->findById($id);

        if ($type) {
            return $type->delete();
        }

        return false;
    }
}
