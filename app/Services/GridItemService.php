<?php

namespace App\Services;

use App\DTO\Grid\Item\CreateGridItemDTO;
use App\DTO\Grid\Item\UpdateGridItemDTO;
use App\Repositories\GridItemRepository;

class GridItemService
{
    protected $repository;

    public function __construct(GridItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        $gridItemDTO = CreateGridItemDTO::fromRequest([
            ...$request->only(['size', 'order', 'gridGroupID']),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($gridItemDTO->toArray());
    }

    public function update($request)
    {
        $gridItemDTO = UpdateGridItemDTO::fromRequest([
            ...$request->only(['size', 'order', 'active']),
        ]);

        return $this->repository->update($request->id, $gridItemDTO->toArray());
    }
}
