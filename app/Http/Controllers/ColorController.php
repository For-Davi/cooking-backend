<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductColor\CreateProductColorRequest;
use App\Http\Requests\ProductColor\DeleteProductColorRequest;
use App\Http\Requests\ProductColor\UpdateProductColorRequest;
use App\Repositories\ProductColorRepository;
use App\Services\ProductColorService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController
{
    private $service;

    private $repository;

    public function __construct(ProductColorService $service, ProductColorRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $colors = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

            return response()->json(['colors' => $colors], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar cores:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar cores'], 500);
        }
    }

    public function store(CreateProductColorRequest $request)
    {
        try {
            DB::beginTransaction();
            $department = $this->service->create($request);

            if ($department) {
                DB::commit();

                return response()->json(['message' => 'Cor cadastrada'], 201);
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
            $department = $this->service->update($request);

            if ($department) {
                DB::commit();

                return response()->json(['message' => 'Cor atualizada'], 200);
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
