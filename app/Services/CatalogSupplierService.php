<?php

namespace App\Services;

use App\DTO\Supplier\Catalog\CreateCatalogSupplierDTO;
use App\DTO\Supplier\Catalog\UpdateCatalogSupplierDTO;
use App\Repositories\CategorySupplierRepository;

class CatalogSupplierService
{
    protected $repository;

    public function __construct(CategorySupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        $catalogDTO = CreateCatalogSupplierDTO::fromRequest([
            ...$request->only(['name', 'type', 'supplierId', 'description']),
            'enterpriseId' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($catalogDTO->toArray());
    }

    public function update($request)
    {
        $catalogDTO = UpdateCatalogSupplierDTO::fromRequest([
            ...$request->only(['name', 'type', 'description']),
        ]);

        return $this->repository->update($request->id, $catalogDTO->toArray());
    }
}
