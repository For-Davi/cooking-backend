<?php

namespace App\Services;

use App\DTO\Supplier\CreateSupplierDTO;
use App\Repositories\SupplierRepository;

class SupplierService
{
    protected $repository;

    public function __construct(SupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        $supplierDTO = CreateSupplierDTO::fromRequest([
            ...$request->only([
                'name',
                'email',
                'cpf',
                'cnpj',
                'stateRegistration',
                'municipalRegistration',
                'phone',
                'site',
                'country',
                'state',
                'city',
                'cep',
                'neighborhood',
                'address',
                'number',
                'categorySupplierId',
                'description',
            ]),
            'enterpriseId' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($supplierDTO->toArray());
    }

    public function update($request)
    {
        DepartmentHelper::existsDepartment(
            $request->input('id'),
            $request->input('name'),
            $request->get('enterprise_id'),
            'update'
        );

        $departmentDTO = UpdateDepartmentDTO::fromRequest([
            ...$request->only(['name', 'parentId']),
        ]);

        return $this->repository->update($request->input('id'), $departmentDTO->toArray());
    }
}
