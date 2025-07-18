<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductServiceController
{
    public function __construct(
        private ProductService $service,
        private ProductRepository $repository
    ) {}

    public function index(Request $request)
    {
        try {
            $products = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

            return response()->json(['products' => $products], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar produtos:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar produtos'], 500);
        }
    }

    public function store(CreateProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $color = $this->service->create($request);

            if ($color) {
                DB::commit();
                $colors = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['colors' => $colors, 'message' => 'Cor cadastrada'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar cor:', $e, $request);

            return response()->json(['message' => 'Erro ao cadastrar cor'], 500);
        }
    }

    public function update(UpdateProductColorRequest $request)
    {
        try {
            DB::beginTransaction();
            $color = $this->service->update($request);

            if ($color) {
                DB::commit();

                $colors = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['colors' => $colors, 'message' => 'Cor atualizada'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar cor:', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar cor'], 500);
        }
    }

    public function destroy(DeleteProductColorRequest $request)
    {
        try {
            DB::beginTransaction();

            $color = $this->repository->delete($request->route('colorID'));

            if ($color) {
                DB::commit();
                $colors = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['colors' => $colors, 'message' => 'Cor excluída'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir cor:', $e, $request);

            return response()->json(['message' => 'Erro ao excluir cor'], 500);
        }
    }
}
