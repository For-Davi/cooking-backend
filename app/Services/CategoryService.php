<?php

namespace App\Services;

use App\DTO\Category\CreateCategoryDTO;
use App\DTO\Category\UpdateCategoryDTO;
use App\Helpers\CategoryHelper;
use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(protected CategoryRepository $repository) {}

    public function create($request)
    {
        CategoryHelper::existsCategory(
            $request->name,
            'create'
        );

        $categoryDTO = CreateCategoryDTO::fromRequest([
            ...$request->only(['name']),
        ]);

        return $this->repository->create($categoryDTO->toArray());
    }

    public function update($request)
    {
        CategoryHelper::existsCategory(
            $request->name,
            'update',
            $request->id
        );

        $categoryDTO = UpdateCategoryDTO::fromRequest([
            ...$request->only(['name']),
        ]);

        return $this->repository->update($request->id, $categoryDTO->toArray());
    }
}
