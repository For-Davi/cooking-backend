<?php

namespace App\Repositories;

use App\Models\Enterprise;
use Illuminate\Support\Facades\DB;

class EnterpriseRepository
{
    protected $model;

    public function __construct(Enterprise $enterprise)
    {
        $this->model = $enterprise;
    }

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
}
