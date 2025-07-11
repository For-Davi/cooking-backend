<?php

namespace App\Repositories;

use App\Models\CategorySupplier;
use Illuminate\Support\Facades\DB;

class CategorySupplierRepository
{
    public function __construct(protected CategorySupplier $model) {}

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
        $category = $this->findById($id);
        if ($category) {
            $category->update($data);

            return $category;
        }

        return null;
    }

    public function delete($id)
    {
        $category = $this->findById($id);

        if ($category) {
            DB::table('suppliers')
                ->where('enterprise_id', $category->enterprise_id)
                ->where('category_supplier_id', $category->id)
                ->update(['category_supplier_id' => null]);

            return $category->delete();
        }

        return false;
    }
}
