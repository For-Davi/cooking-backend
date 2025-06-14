<?php

namespace App\Services;

use App\DTO\Supplier\CreateSupplierDTO;
use App\DTO\Supplier\UpdateSupplierDTO;
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
                'complement',
            ]),
            'enterpriseId' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($supplierDTO->toArray());
    }

    public function update($request)
    {
        $supplierDTO = UpdateSupplierDTO::fromRequest([
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
                'active',
                'complement',
            ]),
            'enterpriseId' => $request->get('enterprise_id'),
        ]);

        return $this->repository->update($request->id, $supplierDTO->toArray());
    }
}
