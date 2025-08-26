<?php

namespace App\Services;

use App\DTO\Supplier\Catalog\CreateSupplierCatalogDTO;
use App\DTO\Supplier\Catalog\UpdateSupplierCatalogDTO;
use App\Repositories\SupplierCatalogRepository;

class SupplierCatalogService
{
    public function __construct(protected SupplierCatalogRepository $repository) {}

    public function create($request)
    {
        $catalogDTO = CreateSupplierCatalogDTO::fromRequest([
            ...$request->only(['productVariantID', 'price', 'supplierID', 'description']),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($catalogDTO->toArray());
    }

    public function update($request)
    {
        $catalogDTO = UpdateSupplierCatalogDTO::fromRequest([
            ...$request->only(['productVariantID', 'price', 'supplierID', 'description']),
        ]);


        return $this->repository->update(
        $catalogDTO->supplier_id,
        $catalogDTO->product_variant_id,
        $catalogDTO->toArray()
    );
    }
}
