<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserListResource;
use App\Repositories\EnterpriseRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Utils\ErrorLogger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ErrorLogger::log('Erro ao logar com usuário:', $e, $request);

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

            ErrorLogger::log('Erro ao registrar com usuário:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $users = $this->repository->getAllByEnterprise($request->get('enterprise_id'), ['department', 'role']);

            return response()->json(['users' => UserListResource::collection($users)], 200);

        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao listar membros da organização:', $e, $request);

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

            ErrorLogger::log('Erro ao registrar membro da organização:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->service->update($request);

            if ($user) {
                DB::commit();

                $users = $this->repository->getAllByEnterprise($request->get('enterprise_id'), ['department', 'role']);

                return response()->json(['users' => UserListResource::collection($users), 'message' => 'Membro atualizado'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar membro da organização:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(DeleteUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->repository->delete($request->route('id'));

            if ($user) {
                DB::commit();

                $users = $this->repository->getAllByEnterprise($request->get('enterprise_id'), ['department', 'role']);

                return response()->json(['users' => UserListResource::collection($users), 'message' => 'Membro excluído'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir membro da organização:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
