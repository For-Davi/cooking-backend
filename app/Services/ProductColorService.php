<?php

namespace App\Services;

use App\DTO\ProductColor\CreateProductColorDTO;
use App\DTO\ProductColor\UpdateProductColorDTO;
use App\Helpers\ProductColorHelper;
use App\Repositories\ProductColorRepository;

class ProductColorService
{
    public function __construct(protected ProductColorRepository $repository) {}

    public function create($request)
    {
        ProductColorHelper::existsColor(
            $request->get('enterprise_id'),
            $request->name,
            'create'
        );

        $productColorDTO = CreateProductColorDTO::fromRequest([
            ...$request->only(['name', 'hexColorCode']),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($productColorDTO->toArray());
    }

    public function update($request)
    {
        ProductColorHelper::existsColor(
            $request->get('enterprise_id'),
            $request->name,
            'update',
            $request->id
        );

        $productColorDTO = UpdateProductColorDTO::fromRequest([
            ...$request->only(['name', 'active', 'hexColorCode']),
        ]);

        return $this->repository->update($request->id, $productColorDTO->toArray());
    }
}
