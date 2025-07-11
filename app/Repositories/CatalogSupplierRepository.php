<?php

namespace App\Repositories;

use App\Models\CatalogSupplier;

class CatalogSupplierRepository
{
    public function __construct(protected CatalogSupplier $model) {}

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
        $item = $this->findById($id);
        if ($item) {
            $item->update($data);

            return $item;
        }

        return null;
    }

    public function delete($id)
    {
        $item = $this->findById($id);

        if ($item) {
            return $item->delete();
        }

        return false;
    }
}
