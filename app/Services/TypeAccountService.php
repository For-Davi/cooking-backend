<?php

namespace App\Services;

use App\DTO\Account\Type\CreateTypeAccountDTO;
use App\DTO\Account\Type\UpdateTypeAccountDTO;
use App\Helpers\TypeAccountHelper;
use App\Repositories\TypeAccountRepository;

class TypeAccountService
{
    public function __construct(protected TypeAccountRepository $repository) {}

    public function create($request)
    {
        TypeAccountHelper::existsType(
            $request->get('enterprise_id'),
            $request->name,
            'create'
        );

        $categoryDTO = CreateTypeAccountDTO::fromRequest([
            ...$request->only(['name']),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($categoryDTO->toArray());
    }

    public function update($request)
    {
        TypeAccountHelper::existsType(
            $request->get('enterprise_id'),
            $request->name,
            'update',
            $request->id
        );

        $categoryDTO = UpdateTypeAccountDTO::fromRequest([
            ...$request->only(['name']),
        ]);

        return $this->repository->update($request->id, $categoryDTO->toArray());
    }
}
