<?php

namespace App\Services;

use App\DTO\Grid\Group\CreateGridGroupDTO;
use App\DTO\Grid\Group\UpdateGridGroupDTO;
use App\DTO\Grid\Item\CreateGridItemDTO;
use App\DTO\Grid\Item\UpdateGridItemDTO;
use App\Repositories\GridGroupRepository;
use App\Repositories\GridItemRepository;

class GridGroupService
{
    protected $repository;

    protected $gridItemRepository;

    public function __construct(GridGroupRepository $repository, GridItemRepository $gridItemRepository)
    {
        $this->repository = $repository;
        $this->gridItemRepository = $gridItemRepository;
    }

    public function create($request)
    {
        $gridGroupDTO = CreateGridGroupDTO::fromRequest([
            ...$request->only(['name']),
            'enterprise_id' => $request->get('enterprise_id'),
        ]);

        $gridGroup = $this->repository->create($gridGroupDTO->toArray());
        $this->createItem($gridGroup->id, $request->itens);

        return true;
    }

    private function createItem(int $gridGroupID, array $itens)
    {
        foreach ($itens as $item) {
            $gridItemDTO = CreateGridItemDTO::fromRequest([
                'size' => $item['size'],
                'order' => $item['order'],
                'enterpriseID' => $item['enterprise_id'],
                'gridGroupID' => $gridGroupID,
            ]);

            $this->gridItemRepository->create($gridItemDTO->toArray());
        }
    }

    public function update($request)
    {
        $gridGroupDTO = UpdateGridGroupDTO::fromRequest([
            ...$request->only(['name', 'active']),
        ]);

        $this->repository->update($request->id, $gridGroupDTO->toArray());
        $this->updateItem($request->itens);

        return true;
    }

    public function updateItem(array $itens)
    {
        foreach ($itens as $item) {
            $gridItemDTO = UpdateGridItemDTO::fromRequest([
                'size' => $item['size'],
                'order' => $item['order'],
                'enterpriseID' => $item['enterprise_id'],
            ]);

            $this->gridItemRepository->update($item['id'], $gridItemDTO->toArray());
        }
    }
}
