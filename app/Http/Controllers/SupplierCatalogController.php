<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\Catalog\CreateCatalogSupplierRequest;
use App\Http\Requests\Supplier\Catalog\DeleteCatalogSupplierRequest;
use App\Http\Requests\Supplier\Catalog\GetByVariantCatalogSupplierRequest;
use App\Http\Requests\Supplier\Catalog\UpdateCatalogSupplierRequest;
use App\Http\Resources\Product\ProductsLinkedResource;
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
            $catalog = $this->repository->getBySupplier($request->route('supplierID'), ['variant.product', 'variant.color', 'supplier']);

            return response()->json(['catalog' => ProductsLinkedResource::collection($catalog)], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar catálogos:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar catálogos'], 500);
        }
    }

    public function getByVariant(GetByVariantCatalogSupplierRequest $request)
    {
        try {

            $catalog = $this->repository->getByVariant($request->variantID, ['variant.product', 'variant.color', 'supplier']);

            return response()->json([
                'catalog' => ProductsLinkedResource::collection($catalog),
            ], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar fornecedores por produto:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar fornecedores'], 500);
        }
    }

    public function store(CreateCatalogSupplierRequest $request)
    {
        try {
            DB::beginTransaction();
            $item = $this->service->create($request);

            if ($item) {
                DB::commit();

                $catalog = $this->repository->getBySupplier($request->supplierID, ['variant.product', 'variant.color', 'supplier']);

                return response()->json(['catalog' => ProductsLinkedResource::collection($catalog), 'message' => 'Item de catálogo cadastrado'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar item de catálogo:', $e, $request);

            return response()->json(['message' => 'Erro ao cadastrar item de catálogo'], 500);
        }
    }

    public function update(UpdateCatalogSupplierRequest $request)
    {
        try {
            DB::beginTransaction();
            $catalog = $this->service->update($request);

            if ($catalog) {
                DB::commit();

                $catalog = $this->repository->getBySupplier($request->supplierID, ['variant.product', 'variant.color', 'supplier']);

                return response()->json(['catalog' => ProductsLinkedResource::collection($catalog), 'message' => 'Categoria atualizada'], 200);
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

            $deleted = $this->repository->delete($supplierID, $productVariantID);

            if ($deleted) {
                DB::commit();
                $catalog = $this->repository->getBySupplier($request->supplierID, ['variant.product', 'variant.color', 'supplier']);

                return response()->json([
                    'catalog' => ProductsLinkedResource::collection($catalog),
                    'message' => 'Item de catálogo excluído',
                ], 200);
            }

            DB::rollBack();

            return response()->json(['message' => 'Item não encontrado'], 404);

        } catch (\Exception $e) {
            DB::rollBack();
            ErrorLogger::log('Erro ao excluir categoria:', $e, $request);

            return response()->json(['message' => 'Erro ao excluir categoria'], 500);
        }
    }
}
