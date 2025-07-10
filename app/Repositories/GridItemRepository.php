<?php

namespace App\Repositories;

use App\Models\GridItem;

// use Illuminate\Support\Facades\DB;

class GridItemRepository
{
    protected $model;

    public function __construct(GridItem $model)
    {
        $this->model = $model;
    }

    public function getAllByEnterprise($enterpriseId)
    {
        return $this->model->where('enterprise_id', $enterpriseId)->get();
    }

    public function getAllByGroup($gridGroupID)
    {
        return $this->model
            ->where('grid_group_id', $gridGroupID)
            ->orderBy('order', 'asc')
            ->get();
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
        $gridItem = $this->findById($id);
        if ($gridItem) {
            $gridItem->update($data);

            return $gridItem;
        }

        return null;
    }

    public function deleteAllByGroup($groupId)
    {
        $this->model->where('grid_group_id', $groupId)->delete();
    }

    public function delete($id)
    {
        $gridItem = $this->findById($id);

        if ($gridItem) {

            // TODO: Quando criar a tabela de produtos deve descomentar esse codigo abaixo
            // DB::table('catalogs')
            //     ->where('enterprise_id', $color->enterprise_id)
            //     ->where('color_id', $color->id)
            //     ->update(['color_id' => null]);

            return $gridItem->delete();
        }

        return false;
    }
}
