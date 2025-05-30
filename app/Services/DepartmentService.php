<?php

namespace App\Services;

use App\DTO\Department\CreateDepartmentDTO;
use App\DTO\Department\UpdateDepartmentDTO;
use App\Helpers\DepartmentHelper;
use App\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        DepartmentHelper::existsDepartment(
            null,
            $request->input('name'),
            $request->get('enterprise_id'),
            'create'
        );

        $departmentDTO = CreateDepartmentDTO::fromRequest([
            ...$request->only(['name', 'parentId']),
            'enterprise_id' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($departmentDTO->toArray());
    }

    public function update($request)
    {
        DepartmentHelper::existsDepartment(
            $request->input('id'),
            $request->input('name'),
            $request->get('enterprise_id'),
            'update'
        );

        $departmentDTO = UpdateDepartmentDTO::fromRequest([
            ...$request->only(['name', 'parentId']),
        ]);

        return $this->repository->update($request->input('id'), $departmentDTO->toArray());
    }
}
