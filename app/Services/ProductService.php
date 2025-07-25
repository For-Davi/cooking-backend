<?php

namespace App\Services;

use App\DTO\Image\CreateImageDTO;
use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\ProductAdvanced\CreateProductAdvancedDTO;
use App\DTO\Product\ProductImage\CreateProductImageDTO;
use App\DTO\Product\ProductTag\CreateProductTagDTO;
use App\Helpers\ProductHelper;
use App\Helpers\ProductLogHelper;
use App\Repositories\ImageRepository;
use App\Repositories\ProductAdvancedRepository;
use App\Repositories\ProductColorRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\ProductTagRepository;

class ProductService
{
    protected ?int $enterpriseID = null;

    public function __construct(protected ProductColorRepository $repository, protected ProductTagRepository $productTagRepository, protected ProductAdvancedRepository $productAdvancedRepository, protected ImageRepository $imageRepository, protected ProductImageRepository $productImageRepository) {}

    public function create($request)
    {
        $this->enterpriseID = $request->get('enterprise_id');

        // Verifica se tem algum produto com o mesmo nome
        ProductHelper::existsProduct(
            $request->get('enterprise_id'),
            $request->name,
            'create'
        );

        $productDTO = CreateProductDTO::fromRequest([
            ...$request->only(['name', 'type', 'description', 'categoryID']),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        // Cria o produto
        $product = $this->repository->create($productDTO->toArray());

        // Cria as configurações avançadas
        $this->createAdvancedForProduct($request->advanced, $product->id);

        // Cria as variantes
        $this->createVariantForProduct($request->variants, $product->id);

        // Salva as imagens
        if (count($request->images) > 0) {
            foreach ($request->images as $image) {
                $path = $this->savePathImage($image);

                $imageDTO = CreateImageDTO::fromRequest([
                    'url' => $path,
                    'name' => $image->name,
                    'enterpriseID' => $this->enterpriseID,
                ]);

                $imageSaved = $this->imageRepository->create($imageDTO->toArray());

                $productImageDTO = CreateProductImageDTO::fromRequest([
                    'imageID' => $imageSaved->id,
                    'productID' => $product->id,
                ]);

                $this->productImageRepository->create($productImageDTO->toArray());
            }
        }

        // Analisa e cria a relação com as tags
        if (count($request->tags) > 0) {
            foreach ($request->tags as $tag) {
                $this->createTagForProduct($tag['id'], $product->id);
            }
        }

        // Criação de log do produto
        ProductLogHelper::createLog(
            $product->id,
            'create',
            "O usuário(a) {auth()->user()->name} ({auth()->user()->email}) criou este produto em {now()->format('d/m/Y H:i:s')}"
        );

        return true;
    }

    private function createTagForProduct(int $tagID, int $productID)
    {
        $productTagDTO = CreateProductTagDTO::fromRequest([
            'tagID' => $tagID,
            'productID' => $productID,
        ]);

        $this->productTagRepository->create($productTagDTO->toArray());
    }

    private function createAdvancedForProduct(array $advanced, int $productID)
    {
        $productAdvancedDTO = CreateProductAdvancedDTO::fromRequest([
            'active' => $advanced['active'],
            'allowCoupon' => $advanced['allowCoupon'],
            'allowDiscount' => $advanced['allowDiscount'],
            'discountMaxPercentage' => $advanced['discountMaxPercentage'],
            'hasCommission' => $advanced['hasCommission'],
            'commissionPercentage' => $advanced['commissionPercentage'],
            'productID' => $productID,
        ]);

        $this->productAdvancedRepository->create($productAdvancedDTO->toArray());
    }

    private function createVariantForProduct(array $variants, int $productID)
    {
        foreach ($variants as $variant) {
            if (count($variant->colors) > 0) {
                foreach ($variant->colors as $color) {
                    $productVariantDTO = CreateProductVariantDTO::fromRequest([
                        'active' => $variant['active'],
                        'sku' => $variant['sku'],
                        'description' => $variant['description'],
                        'location' => $variant['location'],
                        'gridItemID' => $variant['gridItemID'],
                        'colorID' => $color['id'],
                        'price' => $variant['price'],
                        'cost' => $variant['cost'],
                        'stockQuantity' => $variant['stockQuantity'],
                        'minStockQuantity' => $variant['minStockQuantity'],
                        'productID' => $productID,
                        'enterpriseID' => $this->enterpriseID,
                    ]);
                    $this->productAdvancedRepository->create($productVariantDTO->toArray());
                }
            }
        }
    }

    private function savePathImage($image)
    {
        $path = $image->store('images', config('filesystems.default'));

        if (app()->environment('local')) {
            $path = $image->store('public/images');

            return Storage::url($path);
        }

        return $path;
    }

    // public function update($request)
    // {
    //     ProductColorHelper::existsColor(
    //         $request->get('enterprise_id'),
    //         $request->name,
    //         'update',
    //         $request->id
    //     );

    //     $productColorDTO = UpdateProductColorDTO::fromRequest([
    //         ...$request->only(['name', 'active', 'hexColorCode']),
    //     ]);

    //     return $this->repository->update($request->id, $productColorDTO->toArray());
    // }
}
