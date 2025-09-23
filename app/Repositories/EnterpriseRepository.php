<?php

namespace App\Repositories;

use App\Models\Enterprise;
use Illuminate\Support\Facades\DB;

class EnterpriseRepository
{
    public function __construct(protected Enterprise $model) {}

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findByCpf($cpf)
    {
        return $this->model->where('cpf', $cpf)->first();
    }

    public function findByCnpj($cnpj)
    {
        return $this->model->where('cnpj', $cnpj)->first();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $enterprise = $this->findById($id);
        if ($enterprise) {
            $enterprise->update($data);

            return $enterprise;
        }

        return null;
    }

    public function delete($id)
    {
        $enterprise = $this->findById($id);
        if ($enterprise) {

            DB::table('users')->where('enterprise_id', $id)->delete();

            return $enterprise->delete();
        }

        return false;
    }

    public function deleteEnterpriseData($enterprise)
    {
        if ($enterprise) {
            $enterpriseID = $enterprise->id;

            DB::table('users')
                ->whereIn('role_id', function ($query) use ($enterpriseID) {
                    $query->select('id')
                        ->from('roles')
                        ->where('enterprise_id', $enterpriseID);
                })
                ->delete();

            DB::table('roles')->where('enterprise_id', $enterpriseID)->delete();

            DB::table('setting_appearance')
                ->where('enterprise_id', $enterpriseID)
                ->delete();

            DB::table('setting_system')
                ->where('enterprise_id', $enterpriseID)
                ->delete();

            $enterprise->delete();

            return true;
        }

        return null;
    }
}
