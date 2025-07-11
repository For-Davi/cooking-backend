<?php

namespace App\Services;

use App\DTO\Supplier\Category\CreateCategorySupplierDTO;
use App\DTO\Supplier\Category\UpdateCategorySupplierDTO;
use App\Helpers\CategorySupplierHelper;
use App\Repositories\CategorySupplierRepository;

class CategorySupplierService
{
    public function __construct(protected CategorySupplierRepository $repository) {}

    public function create($request)
    {
        CategorySupplierHelper::existsCategory(
            $request->get('enterprise_id'),
            $request->name,
            'create'
        );

        $categoryDTO = CreateCategorySupplierDTO::fromRequest([
            ...$request->only(['name']),
            'enterprise_id' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($categoryDTO->toArray());
    }

    public function update($request)
    {
        CategorySupplierHelper::existsCategory(
            $request->get('enterprise_id'),
            $request->name,
            'update',
            $request->id
        );

        $categoryDTO = UpdateCategorySupplierDTO::fromRequest([
            ...$request->only(['name']),
        ]);

        return $this->repository->update($request->id, $categoryDTO->toArray());
    }
}
