<?php

namespace App\Services;

use App\DTO\Enterprise\EnterpriseStartDTO;
use App\DTO\User\UserStartDTO;
use App\Helpers\UserHelper;
use App\Repositories\EnterpriseRepository;
use App\Repositories\UserRepository;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected $repository;

    protected $enterpriseRepository;

    public function __construct(
        UserRepository $repository,
        EnterpriseRepository $enterpriseRepository,
    ) {
        $this->repository = $repository;
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

    public function create($request)
    {
        $enterpriseDTO = EnterpriseStartDTO::fromRequest($request->only(['nameEnterprise']));
        $enterprise = $this->enterpriseRepository->create($enterpriseDTO->toArray());

        $userDTO = UserStartDTO::fromRequest([
            ...$request->only(['name', 'password', 'email']),
            'enterprise_id' => $enterprise->id,
        ]);

        return $this->repository->create($userDTO->toArray());
    }
}
