<?php

namespace App\Repositories;

use App\Contracts\Repositories\RevenueRepositoryInterface;
use App\DTO\Revenue\UpdateRevenueImageDTO;
use App\Models\Revenue;
use Illuminate\Support\Facades\DB;

class RevenueRepository implements RevenueRepositoryInterface
{
    public function __construct(protected Revenue $model) {}

    public function getAllByUser($relations)
    {
        return $this->model
            ->with($relations)
            ->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function updateImage(int $revenueID, UpdateRevenueImageDTO $dto): ?object
    {
        $revenue = $this->findById($revenueID);
        if (! $revenue) {
            return null;
        }

        if ($dto->hasDeleteOperation() && ! $dto->hasAddOperation()) {
            return $this->handleDeleteOperation($revenue, $dto->photo_delete_id);
        }

        if ($dto->hasAddOperation() && ! $dto->hasDeleteOperation()) {
            return $this->handleAddOperation($revenue, $dto->photo_add_id);
        }

        if ($dto->hasBothOperations()) {
            return $this->handleBothOperations($revenue, $dto->photo_add_id, $dto->photo_delete_id);
        }

        return $revenue;
    }

    private function handleAddOperation(object $revenue, int $addID): object
    {
        $revenue->update(['image_id' => $addID]);

        return $revenue;
    }

    private function handleDeleteOperation(object $revenue, int $deleteID): object
    {
        if ($revenue->image_id === $deleteID) {
            $revenue->update(['image_id' => null]);
        }
        $this->deleteImage($deleteID);

        return $revenue;
    }

    private function handleBothOperations(object $revenue, int $addID, int $deleteID): object
    {
        if ($revenue->image_id === $deleteID) {
            $revenue->update(['image_id' => $addID]);
        }
        $this->deleteImage($deleteID);

        return $revenue;
    }

    public function update($id, array $data)
    {
        $revenue = $this->findById($id);
        if ($revenue) {
            $revenue->update($data);

            return $revenue;
        }

        return null;
    }

    public function delete($id)
    {
        $revenue = $this->findById($id);

        if ($revenue) {
            return $revenue->delete();
        }

        return false;
    }

    private function deleteImage(int $imageID): void
    {
        DB::table('images')->where('id', $imageID)->delete();
    }
}
