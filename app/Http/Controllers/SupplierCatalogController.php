<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\Catalog\CreateCatalogSupplierRequest;
use App\Http\Requests\Supplier\Catalog\DeleteCatalogSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierCatalogRequest;
use App\Repositories\SupplierCatalogRepository;
use App\Services\SupplierCatalogService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierCatalogController
{
    public function __construct(
        private SupplierCatalogService $service,
        private SupplierCatalogRepository $repository
    ) {}

    public function index(Request $request)
    {
        try {
           $enterpriseId = $request->get('enterprise_id'); 
           $supplierID = $request->supplierID;
           $catalog = $this->repository->getBySupplier($supplierID, $enterpriseId);

            return response()->json(['catalog' => $catalog], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar catálogos:', $e, $request);
            dd($e);
            return response()->json(['message' => 'Erro ao buscar catálogos'], 500);
        }
    }

    public function show(ShowSupplierCatalogRequest $request)
    {
        try {
            $item = $this->repository->findById($request->route('catalogID'));

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
                dd($catalog);
                return response()->json(['catalog' => $catalog, 'message' => 'Item de catálogo cadastrado'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar item de catálogo:', $e, $request);
            dd($e);
            return response()->json(['message' => 'Erro ao cadastrar item de catálogo'], 500);
        }
    }

    public function update(UpdateSupplierCatalogRequest $request)
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

    public function destroy(DeleteCatalogSupplierRequest $request, $supplierID, $productVariantID)
    {
        try {
            DB::beginTransaction();

            $catalog = $this->repository->delete($request->route('catalogID'));

            if ($catalog) {
               $deleted = $this->repository->delete($supplierID, $productVariantID);

            if ($deleted) {
            DB::commit();
            $catalog = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

            return response()->json([
                'catalog' => $catalog,
                'message' => 'Item de catálogo excluído'
            ], 200);
        }
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir categoria:', $e, $request);
            dd($e);
            return response()->json(['message' => 'Erro ao excluir categoria'], 500);
        }
    }
}
