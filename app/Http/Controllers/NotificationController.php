<?php

namespace App\Http\Controllers;

use App\Repositories\NotificationRepository;
use App\Services\MovementService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController
{
    public function __construct(
        private MovementService $service,
        private NotificationRepository $repository
    ) {}

    public function index(Request $request)
    {
        try {
            $notifications = $this->repository->getAllByUserId($request->user()->id);

            return response()->json(['notifications' => $notifications], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar notificações:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar notificações'], 500);
        }
    }
    // public function update(UpdateMovementRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $movement = $this->service->update($request);

    //         if ($movement) {
    //             DB::commit();

    //             $movements = $this->repository->getAllByEnterprise($request->get('enterprise_id'), true, ['category']);

    //             return response()->json(['movements' => $movements, 'message' => 'Movimentação atualizada'], 200);
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         ErrorLogger::log('Erro ao atualizar movimentação:', $e, $request);

    //         return response()->json(['message' => 'Erro ao atualizar movimentação'], 500);
    //     }
    // }

    // public function destroy(DeleteMovementRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $movement = $this->repository->delete($request->route('movementID'));

    //         if ($movement) {
    //             DB::commit();
    //             $movements = $this->repository->getAllByEnterprise($request->get('enterprise_id'), true, ['category']);

    //             return response()->json(['movements' => $movements, 'message' => 'Movimentação excluída'], 200);
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         ErrorLogger::log('Erro ao excluir movimentação:', $e, $request);

    //         return response()->json(['message' => 'Erro ao excluir movimentação'], 500);
    //     }
    // }
}
