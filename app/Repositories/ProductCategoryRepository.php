<?php

namespace App\Repositories;

use App\Models\SupplierCategory;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository
{
    public function __construct(protected SupplierCategory $model) {}

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
            DB::table('products')
                ->where('enterprise_id', $category->enterprise_id)
                ->where('category_product_id', $category->id)
                ->update(['category_product_id' => null]);

            return $category->delete();
        }

        return false;
    }
}
