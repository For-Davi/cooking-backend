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
        $requestDate = Carbon::createFromFormat('d/m/Y', $request->date);

        if ($request->quantity > 1) {
            $movements = [];
            $startDate = Carbon::createFromFormat('d/m/Y', $request->date);

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
                    'date' => $date->format('d-m-Y'),
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
                'type',
            ]),
            'enterpriseID' => $request->get('enterprise_id'),
            'date' => $requestDate->format('d-m-Y'),
        ]);

        return $this->repository->create($movementDTO->toArray());
    }

    public function update($request)
    {
        $requestDate = Carbon::createFromFormat('d/m/Y', $request->date);
        
        $movementDTO = CreateOrUpdateMovementDTO::fromRequest([
            ...$request->only([
                'value',
                'transactionCategoryID',
                'description',
                'type',
            ]),
            'enterpriseID' => $request->get('enterprise_id'),
            'date' => $requestDate->format('d-m-Y'),
        ]);

        return $this->repository->update($request->id, $movementDTO->toArray());
    }
}
