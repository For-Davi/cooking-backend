<?php

namespace App\Services;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDataDTO;
use App\DTO\User\UpdateUserPasswordDTO;
use App\Helpers\UserHelper;
use App\Jobs\SendResetPasswordEmail;
use App\Models\PasswordResetToken;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function __construct(
        protected UserRepository $repository,
    ) {}

    public function login($request)
    {
        $user = $this->repository->findByEmail($request->email);

        $this->hasUser($user);
        UserHelper::checkPassword($user, $request->password);
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

    public function register($request)
    {
        $userDTO = CreateUserDTO::fromRequest([
            ...$request->only(['name', 'password', 'email']),
        ]);

        return $this->createUser($userDTO->toArray());
    }

    public function reset($request)
    {
        $user = $this->repository->findByEmail($request->input('email'));

        if ($user) {
            $token = app('auth.password.broker')->createToken($user);
            SendResetPasswordEmail::dispatch($user, $token);
        }

        return 'Caso o e-mail esteja em nosso cadastro, você receberá as instruções para redefinição de senha.';
    }

    public function newPassword($request)
    {
        $register = PasswordResetToken::where('token', $request->input('token'))
            ->first();

        if (! $register) {
            return response()->json(['error' => 'Token inválido.'], 400);
        }

        $data = ['password' => Hash::make($request->input('password'))];
        $result = $this->repository->newPassword($register->email, $data);

        $register->delete();

        return $result;
    }

    public function updateData($request)
    {

        $profileDataDTO = UpdateUserDataDTO::fromRequest([
            ...$request->only(['name', 'email']),
        ]);

        return $this->repository->update($request->user()->id, $profileDataDTO->toArray());
    }

    public function updatePassword($request)
    {
        UserHelper::isPasswordEqual(
            $request->user(),
            $request->currentPassword
        );

        $profilePasswordDTO = UpdateUserPasswordDTO::fromRequest([
            'newPassword' => Hash::make($request->newPassword),
        ]);

        return $this->repository->updatePassword($request->user()->id, $profilePasswordDTO->toArray());
    }
}
