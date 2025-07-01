<?php

namespace App\Repositories;

use App\Models\ProductColor;

// use Illuminate\Support\Facades\DB;

class ProductColorRepository
{
    protected $model;

    public function __construct(ProductColor $model)
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
        $color = $this->findById($id);
        if ($color) {
            $color->update($data);

            return $color;
        }

        return null;
    }

    public function delete($id)
    {
        $color = $this->findById($id);

        if ($color) {

            // TODO: Quando criar a tabela de produtos deve descomentar esse codigo abaixo
            // DB::table('catalogs')
            //     ->where('enterprise_id', $color->enterprise_id)
            //     ->where('color_id', $color->id)
            //     ->update(['color_id' => null]);

            return $color->delete();
        }

        return false;
    }
}
