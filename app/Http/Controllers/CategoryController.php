<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryTableListResource;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Support\Facades\DB;

class CategoryController
{
    public function __construct(
        private CategoryService $service,
        private CategoryRepository $repository
    ) {}

    public function index()
    {
        try {
            $categories = $this->repository->getAllByUser();

            return response()->json(['categories' => CategoryTableListResource::collection($categories)], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar categorias'], 500);
        }
    }

    public function store(CreateCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = $this->service->create($request);

            if ($category) {
                DB::commit();

                $categories = $this->repository->getAllByUser();

                return response()->json(['categories' => CategoryTableListResource::collection($categories), 'message' => 'Categoria cadastrada'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Erro ao cadastrar categoria'], 500);
        }
    }

    public function update(UpdateCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = $this->service->update($request);

            if ($category) {
                DB::commit();

                $categories = $this->repository->getAllByUser();

                return response()->json(['categories' => CategoryTableListResource::collection($categories), 'message' => 'Categoria atualizada'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Erro ao atualizar categoria'], 500);
        }
    }

    public function destroy(DeleteCategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $category = $this->repository->delete($request->route('categoryID'));

            if ($category) {
                DB::commit();
                $categories = $this->repository->getAllByUser();

                return response()->json(['categories' => CategoryTableListResource::collection($categories), 'message' => 'Categoria excluída'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Erro ao excluir categoria'], 500);
        }
    }
}
