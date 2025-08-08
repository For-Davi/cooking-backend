<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\Type\CreateTypeAccountRequest;
use App\Http\Requests\Account\Type\DeleteTypeAccountRequest;
use App\Http\Requests\Account\Type\UpdateTypeAccountRequest;
use App\Repositories\TypeAccountRepository;
use App\Services\TypeAccountService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeAccountController
{
    public function __construct(
        private TypeAccountService $service,
        private TypeAccountRepository $repository
    ) {}

    public function index(Request $request)
    {
        try {
            $types = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

            return response()->json(['types' => $types], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar os tipos de contas', $e, $request);

            return response()->json(['message' => 'Erro ao buscar os tipos de contas'], 500);
        }
    }

    public function store(CreateTypeAccountRequest $request)
    {
        try {
            DB::beginTransaction();
            $type = $this->service->create($request);

            if ($type) {
                DB::commit();

                $types = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['types' => $types, 'message' => 'Tipo de conta cadastrado'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar tipo:', $e, $request);

            return response()->json(['message' => 'Erro ao cadastrar tipo'], 500);
        }
    }

    public function update(UpdateTypeAccountRequest $request)
    {
        try {
            DB::beginTransaction();
            $type = $this->service->update($request);

            if ($type) {
                DB::commit();

                $types = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['types' => $types, 'message' => 'Tipo de conta atualizado'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar categoria:', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar tipo'], 500);
        }
    }

    public function destroy(DeleteTypeAccountRequest $request)
    {
        try {
            DB::beginTransaction();

            $type = $this->repository->delete($request->route('typeID'));

            if ($type) {
                DB::commit();
                $types = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['types' => $types, 'message' => 'Tipo de conta excluída'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir tipo de conta:', $e, $request);

            return response()->json(['message' => 'Erro ao excluir o tipo'], 500);
        }
    }
}
