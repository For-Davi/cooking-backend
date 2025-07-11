<?php

namespace App\Services;

use App\DTO\Tag\CreateTagDTO;
use App\DTO\Tag\UpdateTagDTO;
use App\Helpers\TagHelper;
use App\Repositories\TagRepository;

class TagService
{
    public function __construct(protected TagRepository $repository) {}

    public function create($request)
    {
        TagHelper::existsTag(
            $request->get('enterprise_id'),
            $request->name,
            'create'
        );

        $tagDTO = CreateTagDTO::fromRequest([
            ...$request->only(['name']),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($tagDTO->toArray());
    }

    public function update($request)
    {
        TagHelper::existsTag(
            $request->get('enterprise_id'),
            $request->name,
            'update',
            $request->id
        );

        $tagDTO = UpdateTagDTO::fromRequest([
            ...$request->only(['name', 'active']),
        ]);

        return $this->repository->update($request->id, $tagDTO->toArray());
    }
}
