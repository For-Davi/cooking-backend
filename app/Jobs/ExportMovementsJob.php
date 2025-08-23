<?php

namespace App\Jobs;

use App\Services\ExportService;
use App\Repositories\MovementRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportMovementsJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected array $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function handle(MovementRepository $repository, ExportService $exportService)
    {
        $movements = $repository->getAllWithFilter($this->filters);

        if ($movements->isEmpty()) {
            return;
        }

        $filename = 'movimentacoes_' . str_replace('/', '-', $this->filters);

            $exportService->exportExcel($movements, $filename);
        
    }
}

