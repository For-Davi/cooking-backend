<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\CreateFeedbackRequest;
use App\Repositories\FeedbackRepository;
use App\Services\FeedbackService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController
{
    public function __construct(
        private FeedbackService $service,
        private FeedbackRepository $repository
    ) {}

    public function store(CreateFeedbackRequest $request)
    {
        try {
            DB::beginTransaction();
            $suggestion = $this->service->create($request);

            if ($suggestion) {
                DB::commit();

                return response()->json(['message' => 'Sugestão enviada'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao enviar sugestão:', $e, $request);

            return response()->json(['message' => 'Erro ao enviar sugestão'], 500);
        }
    }
}
