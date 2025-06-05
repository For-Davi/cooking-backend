<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserListResource;
use App\Repositories\EnterpriseRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController
{
    private $service;

    private $rule;

    private $repository;

    private $enterpriseRepository;

    public function __construct(UserService $service, UserRepository $repository, EnterpriseRepository $enterpriseRepository)
    {
        $this->service = $service;
        $this->repository = $repository;
        $this->enterpriseRepository = $enterpriseRepository;
    }

    private function configureToken($user)
    {
        $token = $user->createToken('my-app-token');
        $token->accessToken->update([
            'expires_at' => Carbon::now()->addHours(3),
        ]);

        return $token->plainTextToken;
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->service->login($request);
            $user->load('enterprise');

            $token = $this->configureToken($user);

            return response()->json([
                'user' => $user,
                'token' => $token,
                'enterprise_name' => $user->enterprise->name,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Erro ao logar com usuário: '.$e->getMessage());

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->service->register($request);

            if ($user) {
                $token = $this->configureToken($user);

                DB::commit();

                $user->load('enterprise');

                return response()->json([
                    'user' => $user,
                    'token' => $token,
                    'message' => 'Cadastro realizado com sucesso',
                    'enterprise_name' => $user->enterprise->name,
                ], 201);
            }

            throw new \Exception('Falha ao criar usuário');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Erro ao registrar usuário: '.$e->getMessage());

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->service->store($request);

            if ($user) {
                DB::commit();

                $users = $this->repository->getAllByEnterprise($request->get('enterprise_id'), ['department', 'role']);

                return response()->json(['users' => UserListResource::collection($users), 'message' => 'Membro adicionado á sua organização'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Erro ao registrar membro da organização: '.$e->getMessage());

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
