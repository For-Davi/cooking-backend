<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\EnterpriseRepository;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController
{
    private $service;

    private $rule;

    protected $enterpriseRepository;

    public function __construct(UserService $service, EnterpriseRepository $enterpriseRepository)
    {
        $this->service = $service;
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

            $user = $this->service->create($request);

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
}
