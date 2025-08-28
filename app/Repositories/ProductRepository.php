<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function __construct(protected Product $model) {}

    public function getAllByEnterprise($enterpriseId, $relations = null)
    {
        $query = $this->model->where('enterprise_id', $enterpriseId);

        if ($relations) {
            $query->with($relations);
        }

        return $query->get();
    }

    public function findById($id, $relations = null)
    {
        $query = $this->model;

        if ($relations) {
            $query = $query->with($relations);
        }

        return $query->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->findById($id);
        if ($product) {
            $product->update($data);

            return $product;
        }

        return null;
    }

    public function delete($id)
    {
        $product = $this->findById($id);

        if ($product) {
            DB::table('product_variants')->where('product_id', $id)->delete();
            DB::table('product_log')->where('product_id', $id)->delete();
            DB::table('product_tag')->where('product_id', $id)->delete();
            DB::table('product_advanced')->where('product_id', $id)->delete();

            // Processo de exclusão de imagens
            $imageRecords = DB::table('product_image')
                ->where('product_id', $id)
                ->join('images', 'product_image.image_id', '=', 'images.id')
                ->select('images.id', 'images.url')
                ->get();
            if ($imageRecords->isNotEmpty()) {
                DB::table('product_image')->where('product_id', $id)->delete();

                if (env('APP_ENV') === 'local') {
                    foreach ($imageRecords as $image) {
                        $filePath = public_path($image->url);

                        if (file_exists($filePath)) {
                            @unlink($filePath);
                        }
                    }
                }
                $imageIds = $imageRecords->pluck('id')->toArray();
                DB::table('images')->whereIn('id', $imageIds)->delete();
            }

            DB::table('products')->where('id', $id)->delete();

            return true;
        }

        return false;
    }
}
