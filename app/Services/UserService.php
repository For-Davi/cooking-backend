<?php

namespace App\Services;

use App\DTO\Enterprise\EnterpriseStartDTO;
use App\DTO\Role\RoleStartDTO;
use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\DTO\User\UserStartDTO;
use App\Helpers\UserHelper;
use App\Repositories\EnterpriseRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected $repository;

    protected $enterpriseRepository;

    protected $roleRepository;

    public function __construct(
        UserRepository $repository,
        EnterpriseRepository $enterpriseRepository,
        RoleRepository $roleRepository
    ) {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
        $this->enterpriseRepository = $enterpriseRepository;
    }

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
            ...$request->only(['name', 'password', 'email', 'role_id', 'department_id']),
            'enterprise_id' => $request->get('enterprise_id'),
        ]);

        return $this->createUser($userDTO->toArray());
    }

    public function update($request)
    {
        $userDTO = UpdateUserDTO::fromRequest([
            ...$request->only(['name', 'email', 'role_id', 'department_id', 'active']),
        ]);

        return $this->updateUser($request->id, $userDTO->toArray());
    }
}
