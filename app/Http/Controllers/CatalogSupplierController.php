<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\Catalog\CreateCatalogSupplierRequest;
use App\Http\Requests\Supplier\Catalog\DeleteCatalogSupplierRequest;
use App\Http\Requests\Supplier\Catalog\ShowCatalogSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Repositories\CatalogSupplierRepository;
use App\Services\CatalogSupplierService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogSupplierController
{
    public function __construct(
        private CatalogSupplierService $service,
        private CatalogSupplierRepository $repository
    ) {}

    public function index(Request $request)
    {
        try {
            $catalog = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

            return response()->json(['catalog' => $catalog], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar catálogo:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar catálogo'], 500);
        }
    }

    public function show(ShowCatalogSupplierRequest $request)
    {
        try {
            $item = $this->repository->findById($request->route('catalogId'));

            return response()->json(['item' => $item], 200);

        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar item do catálogo:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(CreateCatalogSupplierRequest $request)
    {
        try {
            DB::beginTransaction();
            $item = $this->service->create($request);

            if ($item) {
                DB::commit();

                $catalog = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['catalog' => $catalog, 'message' => 'Item de catálogo cadastrado'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar item de catálogo:', $e, $request);

            return response()->json(['message' => 'Erro ao cadastrar item de catálogo'], 500);
        }
    }

    public function update(UpdateSupplierRequest $request)
    {
        try {
            DB::beginTransaction();
            $catalog = $this->service->update($request);

            if ($catalog) {
                DB::commit();

                $catalog = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['catalog' => $catalog, 'message' => 'Categoria atualizada'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar item do catálogo:', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar item do catálogo'], 500);
        }
    }

    public function destroy(DeleteCatalogSupplierRequest $request)
    {
        try {
            DB::beginTransaction();

            $catalog = $this->repository->delete($request->route('catalogId'));

            if ($catalog) {
                DB::commit();
                $catalog = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['catalog' => $catalog, 'message' => 'Item de catálogo excluído'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir categoria:', $e, $request);

            return response()->json(['message' => 'Erro ao excluir categoria'], 500);
        }
    }
}
