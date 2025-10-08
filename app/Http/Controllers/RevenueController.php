<?php

namespace App\Http\Controllers;


use App\Http\Requests\Revenue\CreateRevenueRequest;
use App\Http\Requests\Revenue\DeleteRevenueRequest;
use App\Http\Requests\Revenue\ShowRevenueRequest;
use App\Http\Requests\Revenue\UpdateRevenueFavoriteRequest;
use App\Http\Requests\Revenue\UpdateRevenueRequest;
use App\Http\Resources\Revenue\RevenueTableListResource;
use App\Repositories\RevenueRepository;
use App\Services\RevenueService;
use Illuminate\Support\Facades\DB;

class RevenueController
{
    public function __construct(
        private RevenueService $service,
        private RevenueRepository $repository,
    ) {}

    public function index()
    {
        try {
            $revenues = $this->repository->getAllByUser(['category', 'image']);
            foreach($revenues as $revenue){
                if($revenue->image){
                    $revenue->image->url = asset($revenue->image->url);
                }
            }

            return response()->json(['revenues' => RevenueTableListResource::collection($revenues)], 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'Erro ao buscar produtos'], 500);
        }
    }

    public function show (ShowRevenueRequest $request)
    {
        try {
            $revenue = $this->repository->findById($request->route('revenueID'));
            $revenue->load(['category','ingredients','image']);

            return response()->json(['revenue' => $revenue], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar receita'], 500);
        }
    }

    public function store(CreateRevenueRequest $request)
    {
        try {
            DB::beginTransaction();
            $revenue = $this->service->create($request);
            if ($revenue) {
                DB::commit();

                $revenues = $this->repository->getAllByUser(['category', 'image']);
                foreach($revenues as $revenue){
                    if($revenue->image){
                        $revenue->image->url = asset($revenue->image->url);
                    }
                }

                return response()->json(['revenues' => RevenueTableListResource::collection($revenues), 'message' => 'Receita cadastrada'], 201);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return response()->json(['message' => 'Erro ao cadastrar receita'], 500);
        }
    }

    public function update(UpdateRevenueRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = $this->service->update($request);

            if ($product) {
                DB::commit();

                $revenues = $this->repository->getAllByUser(['category', 'image']);
                foreach($revenues as $revenue){
                    if($revenue->image){
                        $revenue->image->url = asset($revenue->image->url);
                    }
                }

                return response()->json(['revenues' => RevenueTableListResource::collection($revenues), 'message' => 'Receita atualizada'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Erro ao atualizar receita'], 500);
        }
    }

    public function favorite(UpdateRevenueFavoriteRequest $request)
    {
        try {
            DB::beginTransaction();
            $revenue = $this->service->updateFavorite($request);

            if ($revenue) {
                DB::commit();

                $revenues = $this->repository->getAllByUser(['category', 'image']);
                foreach($revenues as $revenue){
                    if($revenue->image){
                        $revenue->image->url = asset($revenue->image->url);
                    }
                }

                return response()->json(['revenues' => RevenueTableListResource::collection($revenues), 'message' => 'Atualizado favoritação'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Erro ao favoritar receita'], 500);
        }
    }

    public function destroy(DeleteRevenueRequest $request)
    {
        try {
            DB::beginTransaction();

            $revenue = $this->repository->delete($request->route('revenueID'));

            if ($revenue) {
                DB::commit();

                $revenues = $this->repository->getAllByUser(['category', 'image']);
                foreach($revenues as $revenue){
                    if($revenue->image){
                        $revenue->image->url = asset($revenue->image->url);
                    }
                }

                return response()->json(['products' => RevenueTableListResource::collection($revenues), 'message' => 'Receita excluída'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Erro ao excluir receita'], 500);
        }
    }
}
