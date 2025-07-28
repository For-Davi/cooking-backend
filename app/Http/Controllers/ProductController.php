<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Resources\Product\ProductVariantTableResource;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Services\ProductService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController
{
    public function __construct(
        private ProductService $service,
        private ProductRepository $repository,
        private ProductVariantRepository $productVariantRepository
    ) {}

    public function index(Request $request)
    {
        try {
            $productsVariants = $this->productVariantRepository->getAllByEnterprise($request->get('enterprise_id'), ['product', 'images', 'color']);

            return response()->json(['products' => ProductVariantTableResource::collection($productsVariants)], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar produtos:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar produtos'], 500);
        }
    }

    public function store(CreateProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = $this->service->create($request);

            if ($product) {
                DB::commit();
                $productsVariants = $this->productVariantRepository->getAllByEnterprise($request->get('enterprise_id'), ['product', 'images', 'color']);

                return response()->json(['products' => ProductVariantTableResource::collection($productsVariants), 'message' => 'Produto cadastrado'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar produto:', $e, $request);

            return response()->json(['message' => 'Erro ao cadastrar produto'], 500);
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
