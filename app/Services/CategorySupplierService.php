<?php

namespace App\Services;

use App\DTO\Supplier\Category\CreateCategorySupplierDTO;
use App\DTO\Supplier\Category\UpdateCategorySupplierDTO;
use App\Repositories\CategorySupplierRepository;
use CategorySupplierHelper;

class CategorySupplierService
{
    protected $repository;

    public function __construct(CategorySupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        CategorySupplierHelper::existsCategory(
            $request->id,
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
            $request->id,
            $request->name,
            'update'
        );

        $categoryDTO = UpdateCategorySupplierDTO::fromRequest([
            ...$request->only(['name']),
        ]);

        return $this->repository->update($request->id, $categoryDTO->toArray());
    }
}
