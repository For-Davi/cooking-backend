<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\NewPasswordRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\UpdateUserDataRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Jobs\SendWelcomeMailJob;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController
{
    public function __construct(
        protected UserService $service,
        protected UserRepository $repository,
    ) {}

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

            $token = $this->configureToken($user);

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->service->register($request);

            if ($user) {
                DB::commit();

                $token = $this->configureToken($user);

                dispatch(new SendWelcomeMailJob($user));

                return response()->json([
                    'user' => $user,
                    'token' => $token,
                    'message' => 'Cadastro realizado com sucesso',
                ], 201);
            }

            throw new \Exception('Falha ao criar usuário');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function reset(ResetPasswordRequest $request)
    {
        try {
            $result = $this->service->reset($request);

            return response()->json(['message' => $result], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function newPassword(NewPasswordRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->service->newPassword($request);

            if ($user) {
                DB::commit();

                return response()->json(['message' => 'Sua senha foi redefinida'], 200);
            }

            throw new \Exception('Falha ao redefinir senha');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateData(UpdateUserDataRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->service->updateData($request);

            if ($user) {
                DB::commit();

                return response()->json(['user' => $user, 'message' => 'Dados atualizados']);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        try {
            DB::beginTransaction();

            $password = $this->service->updatePassword($request);

            if ($password) {
                DB::commit();

                return response()->json(['message' => 'Senha atualizada']);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(DeleteUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->repository->delete($request->route('userID'));

            if ($user) {
                DB::commit();

                return response()->json([], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
