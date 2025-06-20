<?php

namespace App\Repositories;

use App\DTO\Employee\FilterEmployeeDTO;
use App\Models\Employee;

class EmployeeRepository
{
    protected $model;

    public function __construct(Employee $model)
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

    public function getAllWithFilter(FilterEmployeeDTO $filters)
    {
        $query = $this->model->where('enterprise_id', $filters->enterprise_id);

        if ($filters->name !== null) {
            $query->where('name', 'like', "%{$filters->name}%");
        }

        if ($filters->email !== null) {
            $query->where('email', 'like', "%{$filters->email}%");
        }
        if ($filters->cpf !== null) {
            $query->where('cpf', 'like', "%{$filters->cpf}%");
        }

        if ($filters->cnpj !== null) {
            $query->where('cnpj', 'like', "%{$filters->cnpj}%");
        }

        if ($filters->sex !== null) {
            $query->where('sex', $filters->sex);
        }

        if ($filters->active !== null) {
            $query->where('active', $filters->active);
        }

        if ($filters->has_access_login !== null) {
            $query->where('has_access_login', $filters->has_access_login);
        }

        if ($filters->department_id !== null) {
            $query->where('department_id', $filters->department_id);
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $employee = $this->findById($id);
        if ($employee) {
            $employee->update($data);

            return $employee;
        }

        return null;
    }

    public function delete($id)
    {
        $employee = $this->findById($id);

        if ($employee) {
            return $employee->delete();
        }

        return false;
    }
}
