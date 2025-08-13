<?php

namespace App\Services;

use App\DTO\Movement\CreateOrUpdateMovementDTO;
use App\Repositories\MovementRepository;
use Carbon\Carbon;

class MovementService
{
    public function __construct(protected MovementRepository $repository) {}

    public function create($request)
    {
        if ($request->quantity > 1) {
            $movements = [];

            $startDate = Carbon::parse($request->date);

            for ($i = 0; $i < $request->quantity; $i++) {
                $date = (clone $startDate)->addMonths($i);

                $day = $startDate->day;
                if ($day > $date->daysInMonth) {
                    $date->day($date->daysInMonth);
                }

                $movementDTO = CreateOrUpdateMovementDTO::fromRequest([
                    ...$request->only([
                        'value',
                        'transactionCategoryID',
                        'description',
                        'type',
                    ]),
                    'enterpriseID' => $request->get('enterprise_id'),
                    'date' => $date->format('Y-m-d'),
                ]);

                $movements[] = $this->repository->create($movementDTO->toArray());
            }

            return $movements;
        }

        $movementDTO = CreateOrUpdateMovementDTO::fromRequest([
            ...$request->only([
                'value',
                'transactionCategoryID',
                'description',
                'date',
                'type',
            ]),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->create($movementDTO->toArray());
    }

    public function update($request)
    {
        $movementDTO = CreateOrUpdateMovementDTO::fromRequest([
            ...$request->only([
                'value',
                'transactionCategoryID',
                'description',
                'date',
                'type',
            ]),
            'enterpriseID' => $request->get('enterprise_id'),
        ]);

        return $this->repository->update($request->id, $movementDTO->toArray());
    }
}
