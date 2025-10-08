<?php

namespace App\Services;

use App\DTO\Image\CreateImageDTO;
use App\DTO\Revenue\CreateRevenueDTO;
use App\DTO\Revenue\Ingredient\CreateIngredientDTO;
use App\DTO\Revenue\UpdateRevenueDTO;
use App\DTO\Revenue\UpdateRevenueFavoriteDTO;
use App\DTO\Revenue\UpdateRevenueImageDTO;
use App\Repositories\ImageRepository;
use App\Repositories\RevenueRepository;
use App\Repositories\RevenueIngredientRepository;
use Illuminate\Support\Facades\Storage;

class RevenueService
{
    public function __construct(
        protected RevenueRepository $repository,
        protected RevenueIngredientRepository $revenueIngredientrepository,
        protected ImageRepository $imageRepository
        ) {}

    public function create($request)
    {
        $revenue = $this->createRevenue($request);
        $ingredients = $this->createIngredient($revenue->id, $request->ingredients);
        // dd($ingredients);

        return $revenue && $ingredients;

    }

    private function createRevenue($request)
    {
        $imageID = $this->createImage($request);
        // dd($imageID);

        $revenueDTO = CreateRevenueDTO::fromRequest([
            ...$request->only([
                'name',
                'time',
                'portions',
                'difficulty',
                'preparationMethod',
                'categoryID',
            ]),
            'imageID' => $imageID
        ]);

        return $this->repository->create($revenueDTO->toArray());
    }

    private function createIngredient($revenueID, $ingredients)
    {
        foreach ($ingredients as $ingredient) {
            $dto = CreateIngredientDTO::fromRequest([
            'revenueID' => $revenueID,
            'name' => $ingredient
        ]);

        return $this->revenueIngredientrepository->create($dto->toArray());
        }

    }

    public function update($request)
    {
        $this->updateImage($request);

        $revenueDTO = UpdateRevenueDTO::fromRequest([
            ...$request->only([
                'name',
                'time',
                'portions',
                'difficulty',
                'preparationMethod',
                'categoryID',
            ]),

        ]);

        $revenue = $this->repository->update($request->id, $revenueDTO->toArray());

        $this->revenueIngredientrepository->deleteByRevenue($request->id);

        $ingredients = $this->createIngredient($request->id, $request->ingredients);

        return $revenue && $ingredients;
    }

    public function updateFavorite($request)
    {
        $revenue = $this->repository->findById($request->route('revenueID'));

        $revenueDTO = UpdateRevenueFavoriteDTO::fromRequest([
            "favorite" => $revenue->is_favorite === 1 ? 0 : 1
        ]);
        // dd($request->route('revenueID'), $revenueDTO->toArray());

        return $this->repository->update($request->route('revenueID'), $revenueDTO->toArray());
    }

    private function createImage($request)
    {
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $path = $this->savePathImage($image);

            $imageDTO = CreateImageDTO::fromRequest([
                'url' => $path,
                'name' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
            ]);

            $savedImage = $this->imageRepository->create($imageDTO->toArray());

            return $savedImage->id;
        }
    }

    private function updateImage($request)
    {
        $savedImage = null;

        if ($request->photoDelete) {
            $revenueImageDTO = UpdateRevenueImageDTO::fromRequest(['photoAdd' => null, 'photoDelete' => $request->photoDelete]);

            $imageDelete = $this->imageRepository->findById($revenueImageDTO->photo_delete_id);

            $this->repository->updateImage($request->id, $revenueImageDTO);

            $this->destroyImageStorage($imageDelete->url);
        }

        if ($request->hasFile('photoAdd')) {

            $image = $request->file('photoAdd');

            $path = $this->savePathImage($image);

            $imageDTO = CreateImageDTO::fromRequest([
                'url' => $path,
                'name' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
            ]);

            $savedImage = $this->imageRepository->create($imageDTO->toArray());

            $revenueImageDTO = UpdateRevenueImageDTO::fromRequest(['photoAdd' => $savedImage->id, 'photoDelete' => null]);

            $this->repository->updateImage($request->id, $revenueImageDTO);
        }
    }

    private function savePathImage($image)
    {
        if (! Storage::disk('public')->exists('images')) {
            Storage::disk('public')->makeDirectory('images');
        }

        $path = $image->store('images', 'public');

        return Storage::url($path);
    }

    private function destroyImageStorage($path)
    {
        if (app()->environment('local')) {
            $filePath = public_path($path);
            if (is_file($filePath)) {
                @unlink($filePath);
            }
        }
    }
}
