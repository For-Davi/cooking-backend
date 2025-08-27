<?php

namespace App\Exports\Movement;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MovementsExport
{
    protected Collection $movements;

    public function __construct(Collection $movements)
    {
        $this->movements = $movements;
    }

    public function download($fileName): StreamedResponse
    {
        if ($this->movements->isEmpty()) {
            $emptyData = collect([[
                'VALOR' => '',
                'TIPO' => '',
                'DATA' => '',
                'CATEGORIA' => '',
                'DESCRIÇÃO' => '',
            ]]);

            return (new FastExcel($emptyData))->download($fileName);
        }

        return (new FastExcel($this->movements))->download($fileName, function ($movement) {
            return [
                'VALOR' => $movement->value ?? '',
                'TIPO' => isset($movement->type) ? ($movement->type === 'out' ? 'Saída' : 'Entrada') : '',
                'DATA' => $movement->date ? Carbon::parse($movement->date)->format('d/m/Y') : '',
                'CATEGORIA' => is_object($movement->category) && isset($movement->category->name)
                    ? $movement->category->name
                    : (is_string($movement->category) ? $movement->category : ''),
                'DESCRIÇÃO' => $movement->description ?? '',
            ];
        });
    }
}
