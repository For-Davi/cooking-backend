<?php

namespace App\Services;

use App\DTO\Employee\StartEmployeeDTO;
use App\DTO\Enterprise\EnterpriseStartDTO;
use App\DTO\Role\RoleStartDTO;
use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\DTO\User\UserStartDTO;
use App\Helpers\UserHelper;
use App\Repositories\EmployeeRepository;
use App\Repositories\EnterpriseRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function __construct(
        protected UserRepository $repository,
        protected EnterpriseRepository $enterpriseRepository,
        protected RoleRepository $roleRepository,
        protected EmployeeRepository $employeeRepository
    ) {}

    public function login($request)
    {
        $user = $this->repository->findByEmail($request->email);

        $this->hasUser($user);
        UserHelper::checkPassword($user, $request->password);
        UserHelper::checkUserActive($user);
        UserHelper::clearTokenReset($user);

        return $user;
    }

    private function hasUser($user)
    {
        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais não constam em nosso registro.'],
            ]);
        }
    }

    private function createUser($userDTO)
    {
        return $this->repository->create($userDTO);
    }

    private function updateUser($userId, $userDTO)
    {
        return $this->repository->update($userId, $userDTO);
    }

    private function createEnterprise($enterpriseDTO)
    {
        return $this->enterpriseRepository->create($enterpriseDTO);
    }

    private function createEmployee($employeeDTO)
    {
        return $this->employeeRepository->create($employeeDTO);
    }

    private function startRole($roleDTO)
    {
        return $this->roleRepository->create($roleDTO);
    }

    public function register($request)
    {
        $enterpriseDTO = EnterpriseStartDTO::fromRequest($request->only(['nameEnterprise']));
        $enterprise = $this->createEnterprise($enterpriseDTO->toArray());

        $roleDTO = RoleStartDTO::fromRequest(['enterprise_id' => $enterprise->id]);
        $role = $this->startRole($roleDTO->toArray());

        $userDTO = UserStartDTO::fromRequest([
            ...$request->only(['name', 'password', 'email']),
            'enterprise_id' => $enterprise->id,
            'role_id' => $role->id,
        ]);

        return $this->createUser($userDTO->toArray());
    }

    public function store($request)
    {
        $userDTO = CreateUserDTO::fromRequest([
            ...$request->only(['name', 'password', 'email', 'roleId', 'departmentId']),
            'enterprise_id' => $request->get('enterprise_id'),
        ]);

        $user = $this->createUser($userDTO->toArray());

        if ($request->createEmployee) {
            $employeeDTO = StartEmployeeDTO::fromRequest([
                ...$request->only([
                    'name',
                    'email',
                    'departmentId',
                ]),
                'userId' => $user->id,
                'hasLoginAccess' => 1,
                'enterpriseId' => $request->get('enterprise_id'),
            ]);

            $this->createEmployee($employeeDTO->toArray());
        }

        return true;
    }

    public function update($request)
    {
        $userDTO = UpdateUserDTO::fromRequest([
            ...$request->only(['name', 'email', 'roleId', 'departmentId', 'active']),
        ]);

        return $this->updateUser($request->id, $userDTO->toArray());
    }
}
