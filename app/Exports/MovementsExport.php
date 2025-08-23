<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

class MovementsExport
{
    protected Collection $movements;

    public function __construct(Collection $movements)
    {
        $this->movements = $movements;
    }

    public function download(string $fileName)
    {
      return (new FastExcel($this->movements))->download($fileName, function ($movement) {
            return [
                'ID' => (int) $movement->id,
                'VALOR' => (float) $movement->value,
                'TIPO' => $movement->type === 'out' ? 'Saída' : 'Entrada',
                'DATA' => $movement->date ? Carbon::parse($movement->date)->format('d/m/Y') : '',
                'CATEGORIA' => $movement->category?->name ?? 'Sem categoria',
                'DESCRIÇÃO' => $movement->description ? htmlspecialchars($movement->description, ENT_QUOTES, 'UTF-8') : 'Sem descrição',
            ];
        }); 
    }
}
