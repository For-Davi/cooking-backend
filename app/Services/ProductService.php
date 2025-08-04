<?php

namespace App\Services;

use App\DTO\Image\CreateImageDTO;
use App\DTO\Product\CreateProductDTO;
use App\DTO\Product\ProductAdvanced\CreateProductAdvancedDTO;
use App\DTO\Product\ProductImage\CreateProductImageDTO;
use App\DTO\Product\ProductTag\CreateProductTagDTO;
use App\DTO\Product\ProductVariant\CreateProductVariantDTO;
use App\DTO\Product\ProductVariant\UpdateProductVariantDTO;
use App\Helpers\ProductHelper;
use App\Helpers\ProductLogHelper;
use App\Helpers\SkuHelper;
use App\Repositories\ImageRepository;
use App\Repositories\ProductAdvancedRepository;
use App\Repositories\ProductColorRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTagRepository;
use App\Repositories\ProductVariantRepository;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected ?int $enterpriseID = null;

    public function __construct(protected ProductRepository $repository, protected ProductTagRepository $productTagRepository, protected ProductAdvancedRepository $productAdvancedRepository, protected ImageRepository $imageRepository, protected ProductImageRepository $productImageRepository, protected ProductVariantRepository $productVariantRepository, protected ProductColorRepository $productColorRepository) {}

    public function create($request)
    {
        $this->enterpriseID = $request->get('enterprise_id');

        ProductHelper::existsProduct(
            $request->get('enterprise_id'),
            $request->input('basic.name'),
            'create'
        );

        $productDTO = CreateProductDTO::fromRequest([
            'name' => $request->input('basic.name'),
            'type' => $request->input('basic.type'),
            'description' => $request->input('basic.description'),
            'categoryID' => $request->input('basic.categoryID'),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        // Cria o produto
        $product = $this->repository->create($productDTO->toArray());

        // Cria as configurações avançadas
        $this->createAdvancedForProduct($request->advanced, $product->id);

        // Cria as variantes
        $this->createVariantForProduct($request->variants, $product->id);

        // Salva as imagens
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $this->savePathImage($image);

                $imageDTO = CreateImageDTO::fromRequest([
                    'url' => $path,
                    'name' => $image->getClientOriginalName(),
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
        if ($request->tags && count($request->tags) > 0) {
            foreach ($request->tags as $tag) {
                $this->createTagForProduct($tag['id'], $product->id);
            }
        }

        // Criação de log do produto
        $user = $request->user();
        ProductLogHelper::createLog(
            $product->id,
            'create',
            "O usuário(a) {$user->name} ({$user->email}) criou este produto em ".now()->format('d/m/Y H:i:s')
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

    private function createVariantForProduct(array $variants, int $productID): void
    {
        foreach ($variants as $variant) {
            if (count($variant['colors']) === 0) {
                $this->createBaseVariant($variant, $productID);
            } else {
                $this->createVariantWithColors($variant, $productID);
            }
        }
    }

    private function createVariantWithColors(array $variant, int $productID): void
    {
        foreach ($variant['colors'] as $color) {
            $this->productVariantRepository->create(
                $this->buildVariantDTO($variant, $productID, $color['id'])->toArray()
            );
        }
    }

    private function createBaseVariant(array $variant, int $productID): void
    {
        $this->productVariantRepository->create(
            $this->buildVariantDTO($variant, $productID)->toArray()
        );
    }

    private function buildVariantDTO(array $variant, int $productID, ?int $colorID = null): CreateProductVariantDTO
    {
        $sku = $this->getSku($colorID, $variant['sku']);
        if ($sku !== null) {
            SkuHelper::existsSKU(
                $this->enterpriseID,
                $this->getSku($colorID, $variant['sku']),
                'create',
            );
        }

        return CreateProductVariantDTO::fromRequest([
            'active' => $variant['active'],
            'sku' => $sku,
            'description' => $variant['description'],
            'offer' => $variant['offer'],
            'location' => $variant['location'],
            'gridItemID' => $variant['gridItemID'],
            'colorID' => $colorID,
            'price' => $variant['price'],
            'cost' => $variant['cost'],
            'stockQuantity' => $variant['stockQuantity'],
            'minStockAlert' => $variant['minStockAlert'],
            'productID' => $productID,
            'enterpriseID' => $this->enterpriseID,
        ]);
    }

    private function savePathImage($image)
    {
        $path = '';

        if (app()->environment('local')) {
            $path = $image->store('images');

            $path = Storage::url($path);
        }

        return $path;
    }

    private function getSKU(?string $colorID, ?string $sku): ?string
    {
        if ($sku === null) {
            return null;
        }

        if ($colorID === null) {
            return $sku;
        }

        $productColor = $this->productColorRepository->findById($colorID);
        if ($productColor === null) {
            return $sku;
        }

        return $sku.'-'.strtoupper($productColor->name);
    }

    public function updateVariant($request)
    {
        $this->enterpriseID = $request->get('enterprise_id');

        $sku = $this->getSku($request->colorID, $request->sku);
        if ($sku !== null) {
            SkuHelper::existsSKU(
                $this->enterpriseID,
                $this->getSku($request->colorID, $request->sku),
                'update',
                $request->id
            );
        }

        $productVariantDTO = UpdateProductVariantDTO::fromRequest([
            ...$request->only(['active', 'sku', 'description', 'location', 'price', 'cost', 'offer', 'stockQuantity', 'minStockAlert']),
        ]);

        return $this->productVariantRepository->update($request->id, $productVariantDTO->toArray());
    }
}
