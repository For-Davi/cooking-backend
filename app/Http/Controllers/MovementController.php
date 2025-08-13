<?php

namespace App\Http\Controllers;

use App\DTO\Movement\FilterMovementDTO;
use App\Http\Requests\Movement\CreateMovementRequest;
use App\Http\Requests\Movement\DeleteMovementRequest;
use App\Http\Requests\Movement\FilterMovementRequest;
use App\Http\Requests\Movement\ShowMovementRequest;
use App\Http\Requests\Movement\UpdateMovementRequest;
use App\Repositories\MovementRepository;
use App\Services\MovementService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovementController
{
    public function __construct(
        private MovementService $service,
        private MovementRepository $repository
    ) {}

    public function index(Request $request)
    {
        try {
            $movements = $this->repository->getAllByEnterprise($request->get('enterprise_id'), true, ['category']);

            return response()->json(['movements' => $movements], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar movimentações:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar movimentações'], 500);
        }
    }

    public function show(ShowMovementRequest $request)
    {
        try {
            $movement = $this->repository->findById($request->route('movementID'));

            return response()->json(['movement' => $movement], 200);

        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar movimentação:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function filter(FilterMovementRequest $request)
    {
        try {
            $movementFilterDTO = FilterMovementDTO::fromRequest([
                ...$request->only(['startDate', 'endDate', 'category']),
                'enterpriseID' => $request->get('enterprise_id'),
            ]);
            $movements = $this->repository->getAllWithFilter($movementFilterDTO->toArray());

            return response()->json(['movements' => $movements], 200);

        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao filtrar movimentações:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(CreateMovementRequest $request)
    {
        try {
            DB::beginTransaction();
            $movement = $this->service->create($request);
            if ($movement) {
                DB::commit();

                $movements = $this->repository->getAllByEnterprise($request->get('enterprise_id'), true, ['category']);

                return response()->json(['movements' => $movements, 'message' => 'Movimentação inserida'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao inserir movimentação:', $e, $request);

            return response()->json(['message' => 'Erro ao inserir movimentação'], 500);
        }
    }

    public function update(UpdateMovementRequest $request)
    {
        try {
            DB::beginTransaction();
            $movement = $this->service->update($request);

            if ($movement) {
                DB::commit();

                $movements = $this->repository->getAllByEnterprise($request->get('enterprise_id'), true, ['category']);

                return response()->json(['movements' => $movements, 'message' => 'Movimentação atualizada'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar movimentação:', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar movimentação'], 500);
        }
    }

    public function destroy(DeleteMovementRequest $request)
    {
        try {
            DB::beginTransaction();

            $movement = $this->repository->delete($request->route('movementID'));

            if ($movement) {
                DB::commit();
                $movements = $this->repository->getAllByEnterprise($request->get('enterprise_id'), true, ['category']);

                return response()->json(['movements' => $movements, 'message' => 'Movimentação excluída'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir movimentação:', $e, $request);

            return response()->json(['message' => 'Erro ao excluir movimentação'], 500);
        }
    }
}
