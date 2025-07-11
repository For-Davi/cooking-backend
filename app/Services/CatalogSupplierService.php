<?php

namespace App\Services;

use App\DTO\Supplier\Catalog\CreateCatalogSupplierDTO;
use App\DTO\Supplier\Catalog\UpdateCatalogSupplierDTO;
use App\Repositories\CategorySupplierRepository;

class CatalogSupplierService
{
    public function __construct(protected CategorySupplierRepository $repository) {}

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
