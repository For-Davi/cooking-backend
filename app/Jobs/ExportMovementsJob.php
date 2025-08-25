<?php

namespace App\Jobs;

use App\Exports\Movements\MovementsExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ExportMovementsJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected Collection $movements;

    protected string $filePath;

    public function __construct(Collection $movements, string $filePath)
    {
        $this->movements = $movements;
        $this->filePath = $filePath;
    }

    public function handle(): void
    {
        (new MovementsExport($this->movements))->store($this->filePath);
    }
}
