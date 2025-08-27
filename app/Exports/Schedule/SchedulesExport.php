<?php

namespace App\Exports\Schedule;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SchedulesExport
{
    protected Collection $schedules;

    public function __construct(Collection $schedules)
    {
        $this->schedules = $schedules;
    }

    public function download($fileName): StreamedResponse
    {
        if ($this->schedules->isEmpty()) {
            $emptyData = collect([[
                'VALOR' => '',
                'TIPO' => '',
                'DATA' => '',
                'CATEGORIA' => '',
                'DESCRIÇÃO' => '',
            ]]);

            return (new FastExcel($emptyData))->download($fileName);
        }

        return (new FastExcel($this->schedules))->download($fileName, function ($schedule) {
            return [
                'VALOR' => $schedule->value ?? '',
                'TIPO' => isset($schedule->type) ? ($schedule->type === 'out' ? 'Saída' : 'Entrada') : '',
                'DATA' => $schedule->date ? Carbon::parse($schedule->date)->format('d/m/Y') : '',
                'CATEGORIA' => is_object($schedule->category) && isset($schedule->category->name)
                    ? $schedule->category->name
                    : (is_string($schedule->category) ? $schedule->category : ''),
                'DESCRIÇÃO' => $schedule->description ?? '',
            ];
        });
    }
}
