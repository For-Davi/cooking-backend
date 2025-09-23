<?php

namespace App\Http\Controllers;

use App\Http\Requests\Enterprise\DeleteEnterpriseRequest;
use App\Http\Requests\Enterprise\UpdateEnterpriseRequest;
use App\Repositories\EnterpriseRepository;
use App\Services\EnterpriseService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnterpriseController
{
    public function __construct(
        private EnterpriseRepository $repository,
        private EnterpriseService $service
    ) {}

    public function show(Request $request)
    {
        try {
            $enterprise = $this->repository->findById($request->get('enterprise_id'));

            return response()->json(['enterprise' => $enterprise], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar empresa:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar empresa'], 500);
        }
    }

    public function update(UpdateEnterpriseRequest $request)
    {
        try {
            DB::beginTransaction();
            $enterprise = $this->service->update($request);

            if ($enterprise) {
                DB::commit();

                return response()->json(['message' => 'Dados da empresa atualizados'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar dados da empresa:', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar dados da empresa'], 500);
        }
    }

    public function destroy(DeleteEnterpriseRequest $request)
    {
        try {
            DB::beginTransaction();
            $enterprise = $this->repository->findById($request->route('enterpriseID'));

            if ($enterprise) {
                $this->repository->deleteEnterpriseData($enterprise);

                DB::commit();

                return response()->json(['message' => 'Dados da empresa deletados'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao deletar os dados da empresa:', $e, $request);

            return response()->json(['message' => 'Erro ao deletar os dados da empresa'], 500);
        }
    }
}
