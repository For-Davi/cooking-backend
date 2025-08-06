<?php

namespace App\Repositories;

use App\Models\SettingAppearance;

class SettingAppearanceRepository
{
    public function __construct(protected SettingAppearance $model) {}

    public function create($data)
    {
        return $this->model->create($data);
    }
    
    public function update($id, array $data)
    {
        $appearance = $this->getByEnterprise($id);
        if ($appearance) {
            $appearance->update($data);

            return $appearance;
        }

        return null;
    }

    public function getByEnterprise(int $enterpriseID)
    {
        return $this->model->where('enterprise_id', $enterpriseID)->first();
    }
}
