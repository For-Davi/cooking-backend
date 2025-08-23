<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExportService;
use App\Repositories\MovementRepository;
use App\Http\Requests\Export\ExportRequest;
use App\Jobs\ExportMovementsJob;
use App\Utils\ErrorLogger;

class ExportController
{
    public function exportExcel(Request $request, $date, ExportService $service, MovementRepository $repository)
{
    $user = auth()->user();

    $filters = [
        'enterprise_id' => $user->enterprise_id,
        'category' => $categoryId = ($request->query('category') === 'null') ? null : $request->query('category'),
        'out' => $out = filter_var($request->query('out'), FILTER_VALIDATE_BOOLEAN),
        'entry' => $entry = filter_var($request->query('entry'), FILTER_VALIDATE_BOOLEAN),
        'period' => $date,
    ];

    $movements = $repository->getAllWithFilter($filters)

    ExportMovementsJob::dispatch($filters);

    return $service->exportExcel($movements, "movimentacoes_{$date}");
}
}
