<?php

namespace App\Services;

use App\DTO\Product\Movement\CreateProductMovementDTO;
use App\Repositories\ProductMovementRepository;

class ProductMovementService
{
    public function __construct(
        private ProductMovementRepository $repository
    ) {}

    public function create($request)
    {
        $movementDTO = CreateProductMovementDTO::fromRequest([
            ...$request->only([
                'reason',
                'type',
                'documentNumber',
                'lotNumber',
                'quantity',
                'previousStock',
                'newstock',
                'unitCost',
                'totalCost',
                'productVariantID',
                'supplierID',
                'createdBY',
                'description',
            ]),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->update($request->get('enterprise_id'), $movementDTO->toArray());
    }
}
