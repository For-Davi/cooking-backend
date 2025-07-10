<?php

namespace App\Repositories;

use App\Models\GridGroup;
use Illuminate\Support\Facades\DB;

class GridGroupRepository
{
    protected $model;

    public function __construct(GridGroup $model)
    {
        $this->model = $model;
    }

    public function getAllByEnterprise($enterpriseId, $relations = null)
    {
        $query = $this->model->where('enterprise_id', $enterpriseId);

        if ($relations) {
            $query->with($relations);
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
        $gridGroup = $this->findById($id);
        if ($gridGroup) {
            $gridGroup->update($data);

            return $gridGroup;
        }

        return null;
    }

    public function delete($id)
    {
        $gridGroup = $this->findById($id);

        if ($gridGroup) {

            DB::table('grid_itens')
                ->where('grid_group_id', $gridGroup->id)
                ->delete();

            return $gridGroup->delete();
        }

        return false;
    }
}
