<?php

namespace App\Services;

use App\DTO\Schedule\CreateOrUpdateScheduleDTO;
use App\DTO\Movement\CreateOrUpdateMovementDTO;
use App\Repositories\ScheduleRepository;
use App\Repositories\MovementRepository;
use Carbon\Carbon;

class ScheduleService
{
    public function __construct(protected ScheduleRepository $repository, protected MovementRepository $movementrepository) {}

    public function create($request)
    {
        $requestDate = Carbon::createFromFormat('d/m/Y', $request->date);

        if ($request->quantity > 1) {
            $schedules = [];
            $startDate = Carbon::createFromFormat('d/m/Y', $request->date);

            for ($i = 0; $i < $request->quantity; $i++) {
                $date = (clone $startDate)->addMonths($i);

                $day = $startDate->day;
                if ($day > $date->daysInMonth) {
                    $date->day($date->daysInMonth);
                }

                $scheduleDTO = CreateOrUpdateScheduleDTO::fromRequest([
                    ...$request->only([
                        'value',
                        'transactionCategoryID',
                        'description',
                        'type',
                    ]),
                    'enterpriseID' => $request->get('enterprise_id'),
                    'date' => $date->format('d-m-Y'),
                ]);

                $schedules[] = $this->repository->create($scheduleDTO->toArray());
            }

            return $schedules;
        }

        $scheduleDTO = CreateOrUpdateScheduleDTO::fromRequest([
            ...$request->only([
                'value',
                'transactionCategoryID',
                'description',
                'type',
            ]),
            'enterpriseID' => $request->get('enterprise_id'),
            'date' => $requestDate->format('d-m-Y'),
        ]);

        return $this->repository->create($scheduleDTO->toArray());
    }

    public function update($request)
    {
        $requestDate = Carbon::createFromFormat('d/m/Y', $request->date);

        $scheduleDTO = CreateOrUpdateScheduleDTO::fromRequest([
            ...$request->only([
                'value',
                'transactionCategoryID',
                'description',
                'type',
            ]),
            'enterpriseID' => $request->get('enterprise_id'),
            'date' => $requestDate->format('d-m-Y'),
        ]);

        return $this->repository->update($request->id, $scheduleDTO->toArray());
    }

    public function finishSchedule($request)
    {

        if($request->close === 'date_schedule') {
            $requestDate = Carbon::createFromFormat('d/m/Y', $request->date);

            $scheduleDTO = CreateOrUpdateMovementDTO::fromRequest([
                ...$request->only([
                    'value',
                    'transactionCategoryID',
                    'description',
                    'type',
                ]),
                'enterpriseID' => $request->get('enterprise_id'),
                'date' => $requestDate->format('d-m-Y'),
            ]);
            $this->repository->delete($request->id);
            return $this->movementrepository->create($scheduleDTO->toArray());
        }
        if($request->close === 'date_now') {
        $requestDate = Carbon::createFromFormat('d/m/Y', $request->date);

         $today = now();

       
        $newDate = $requestDate->copy()->month($today->month)->year($today->year);

        $scheduleDTO = CreateOrUpdateMovementDTO::fromRequest([
            ...$request->only([
                'value',
                'transactionCategoryID',
                'description',
                'type',
            ]),
            'enterpriseID' => $request->get('enterprise_id'),
            'date' => $newDate->format('d-m-Y'),
        ]);
          $this->repository->delete($request->id);
        return $this->movementrepository->create($scheduleDTO->toArray());
        }
    }
}
