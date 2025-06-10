<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository
{
    protected $model;

    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }

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
        $supplier = $this->findById($id);
        if ($supplier) {
            $supplier->update($data);

            return $supplier;
        }

        return null;
    }

    public function delete($id)
    {
        $supplier = $this->findById($id);

        if ($supplier) {
            return $supplier->delete();
        }

        return false;
    }
}
