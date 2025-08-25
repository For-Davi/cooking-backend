<?php

namespace App\Repositories;

use App\Models\SupplierCatalog;

class SupplierCatalogRepository
{
    public function __construct(protected SupplierCatalog $model) {}

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

    public function delete($supplierId, $productVariantId)
{
    $item = $this->model
        ->where('supplier_id', $supplierId)
        ->where('product_variant_id', $productVariantId)
        ->first(); 

    if ($item) {
        return $item->delete();
    }

    return false;
}


public function getBySupplier($supplierId, $enterpriseId = null)
{
    $query = $this->model->where('supplier_id', $supplierId);

    if ($enterpriseId) {
        $query->where('enterprise_id', $enterpriseId);
    }

    return $query->get();
}

}
