<?php

namespace App\Repositories;

use App\DTO\Product\FilterProductDTO;
use App\Models\ProductVariant;

// use Illuminate\Support\Facades\DB;

class ProductVariantRepository
{
    public function __construct(protected ProductVariant $model) {}

    public function getAllByEnterprise($enterpriseId, $relations = null)
    {
        $query = $this->model->where('enterprise_id', $enterpriseId);

        if ($relations) {
            $query->with($relations);
        }

        return $query->get();
    }

    public function getAllWithFilter(FilterProductDTO $filters)
    {
        $query = $this->model->where('enterprise_id', $filters->enterpriseID)->with([
            'product', 'images', 'color',
        ]);

        if ($filters->name !== null) {
            $query->where('name', 'like', "%{$filters->name}%");
        }

        if ($filters->sku !== null) {
            $query->where('sku', 'like', "%{$filters->sku}%");
        }

        if ($filters->categoryID !== null) {
            $query->where('product_category_id', $filters->categoryID);
        }

        if ($filters->stockCritical !== null) {
            $operator = $filters->stockCritical == 1 ? '<=' : '>';
            $query->whereColumn('stock_quantity', $operator, 'min_stock_alert');
        }

        if ($filters->active !== null) {
            $query->where('active', $filters->active);
        }

        return $query->get();
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
        $variant = $this->findById($id);
        if ($variant) {
            $variant->update($data);

            return $variant;
        }

        return null;
    }

    // public function delete($id)
    // {
    //     $category = $this->findById($id);

    //     if ($category) {
    //         DB::table('products')
    //             ->where('enterprise_id', $category->enterprise_id)
    //             ->where('product_category_id', $category->id)
    //             ->update(['product_category_id' => null]);

    //         return $category->delete();
    //     }

    //     return false;
    // }
}
