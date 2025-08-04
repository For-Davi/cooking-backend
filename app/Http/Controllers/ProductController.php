<?php

namespace App\Http\Controllers;

use App\DTO\Product\FilterProductDTO;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\FilterProductRequest;
use App\Http\Requests\Product\ShowProductRequest;
use App\Http\Requests\Product\Variant\DeleteProductVariantRequest;
use App\Http\Requests\Product\Variant\ShowProductVariantRequest;
use App\Http\Requests\Product\Variant\UpdateProductVariantRequest;
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

    public function show(ShowProductRequest $request)
    {
        try {
            $product = $this->repository->findById($request->route('productID'), ['variants', 'tags', 'logs', 'advanced', 'images', 'category']);

            return response()->json(['product' => $product]);
        } catch (\Exception $e) {

            ErrorLogger::log('Erro ao buscar produto:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar produto'], 500);
        }
    }

    public function showVariant(ShowProductVariantRequest $request)
    {
        try {
            $variant = $this->productVariantRepository->findById($request->route('variantID'));

            $variant->load([
                'product' => function ($query) {
                    $query->select(['id', 'name', 'type', 'product_category_id']);
                },
                'color' => function ($query) {
                    $query->select(['id', 'name', 'hex_color_code']);
                },
            ]);

            return response()->json(['variant' => $variant]);
        } catch (\Exception $e) {

            ErrorLogger::log('Erro ao buscar variante:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar variante'], 500);
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

    public function filter(FilterProductRequest $request)
    {
        try {
            $productFilterDTO = FilterProductDTO::fromRequest([
                ...$request->only(['name', 'active', 'stockCritical', 'sku', 'category']),
                'enterpriseID' => $request->get('enterprise_id'),
            ]);
            $productsVariants = $this->productVariantRepository->getAllWithFilter($productFilterDTO);

            return response()->json(['products' => ProductVariantTableResource::collection($productsVariants)], 200);

        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao filtrar produtos:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
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

    public function updateVariant(UpdateProductVariantRequest $request)
    {
        try {
            DB::beginTransaction();
            $variant = $this->service->updateVariant($request);

            if ($variant) {
                DB::commit();

                $productsVariants = $this->productVariantRepository->getAllByEnterprise($request->get('enterprise_id'), ['product', 'images', 'color']);

                return response()->json(['products' => ProductVariantTableResource::collection($productsVariants), 'message' => 'Produto atualizado'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar prodputo:', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar produto'], 500);
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

    public function destroyVariant(DeleteProductVariantRequest $request)
    {
        try {
            DB::beginTransaction();

            $variant = $this->productVariantRepository->delete($request->route('variantID'));

            if ($variant) {
                DB::commit();
                $productsVariants = $this->productVariantRepository->getAllByEnterprise($request->get('enterprise_id'), ['product', 'images', 'color']);

                return response()->json(['products' => ProductVariantTableResource::collection($productsVariants), 'message' => 'Variante excluída'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir variante:', $e, $request);

            return response()->json(['message' => 'Erro ao excluir variante'], 500);
        }
    }
}
