<?php

namespace App\Services;

use App\DTO\Employee\CreateEmployeeDTO;
use App\DTO\Employee\UpdateEmployeeDTO;
use App\DTO\User\UserStartDTO;
use App\Repositories\EmployeeRepository;
use App\Repositories\UserRepository;

class EmployeeService
{
    protected $repository;

    protected $userRepository;

    public function __construct(
        EmployeeRepository $repository,
        UserRepository $userRepository,
    ) {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    private function createUser($userDTO)
    {
        return $this->userRepository->create($userDTO);
    }

    public function create($request)
    {
        $userId = null;

        if ($request->hasLoginAccess === 1) {
            $userDTO = UserStartDTO::fromRequest([
                ...$request->only(['name', 'password', 'email', 'roleId', 'departmentId']),
                'enterprise_id' => $request->get('enterprise_id'),
            ]);

            $user = $this->createUser($userDTO->toArray());
            $userId = $user->id;
        }

        $employeeDTO = CreateEmployeeDTO::fromRequest([
            ...$request->only([
                'name',
                'email',
                'sex',
                'phone',
                'cpf',
                'cnpj',
                'stateRegistration',
                'municipalRegistration',
                'dateBirthday',
                'cep',
                'country',
                'state',
                'city',
                'neighborhood',
                'address',
                'number',
                'complement',
                'description',
                'hasLoginAccess',
                'departmentId',
            ]),
            'userId' => $userId,
            'enterpriseId' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($employeeDTO->toArray());
    }

    public function update($request)
    {
        $employeeDTO = UpdateEmployeeDTO::fromRequest([
            ...$request->only([
                'name',
                'email',
                'sex',
                'phone',
                'cpf',
                'cnpj',
                'stateRegistration',
                'municipalRegistration',
                'dateBirthday',
                'cep',
                'country',
                'state',
                'city',
                'neighborhood',
                'address',
                'number',
                'complement',
                'description',
                'hasLoginAccess',
                'departmentId',
            ]),
        ]);

        return $this->repository->update($request->id, $employeeDTO->toArray());
    }
}
