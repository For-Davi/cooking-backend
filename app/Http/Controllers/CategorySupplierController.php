<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\Category\CreateCategorySupplierRequest;
use App\Http\Requests\Supplier\Category\DeleteCategorySupplierRequest;
use App\Http\Requests\Supplier\Category\ShowCategorySupplierRequest;
use App\Http\Requests\Supplier\Category\UpdateCategorySupplierRequest;
use App\Repositories\CategorySupplierRepository;
use App\Services\CategorySupplierService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorySupplierController
{
    private $service;

    private $repository;

    public function __construct(CategorySupplierService $service, CategorySupplierRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $categories = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

            return response()->json(['categories' => $categories], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar categorias:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar categorias'], 500);
        }
    }

    public function show(ShowCategorySupplierRequest $request)
    {
        try {
            $category = $this->repository->findById($request->id);

            return response()->json(['category' => $category], 200);

        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar categoria:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(CreateCategorySupplierRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = $this->service->create($request);

            if ($category) {
                DB::commit();

                $categories = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['categories' => $categories, 'message' => 'Categoria cadastrada'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar categoria:', $e, $request);

            return response()->json(['message' => 'Erro ao cadastrar categoria'], 500);
        }
    }

    public function update(UpdateCategorySupplierRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = $this->service->update($request);

            if ($category) {
                DB::commit();

                $categories = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['categories' => $categories, 'message' => 'Categoria atualizada'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar categoria:', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar categoria'], 500);
        }
    }

    public function destroy(DeleteCategorySupplierRequest $request)
    {
        try {
            DB::beginTransaction();

            $category = $this->repository->delete($request->route('id'));

            if ($category) {
                DB::commit();
                $categories = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['categories' => $categories, 'message' => 'Categoria excluída'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir categoria:', $e, $request);

            return response()->json(['message' => 'Erro ao excluir categoria'], 500);
        }
    }
}
