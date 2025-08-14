<?php

namespace App\Services;

use App\DTO\Receipt\Type\CreateReceiptDTO;
use App\DTO\Receipt\Type\UpdateReceiptDTO;
use App\Repositories\TypeReceiptRepository;

class ReceiptService
{
    public function __construct(protected ReceiptRepository $repository) {}

    public function create($request)
    {
        $receiptDTO = CreateReceiptDTO::fromRequest([
            ...$request->only([
                'identifier',
                'types_id',
                'description',
        ]),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($receiptDTO->toArray());
    }

    public function update($request)
    {
        $receiptDTO = UpdateReceiptDTO::fromRequest([
            ...$request->only([
                'identifier',
                'types_id',
                'active',
                'description',
            ]),
        ]);

        return $this->repository->update($request->id, $receiptDTO->toArray());
    }
}
