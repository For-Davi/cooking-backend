<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Requests\Supplier\CreateSupplierRequest;
use App\Http\Requests\Supplier\DeleteSupplierRequest;
use App\Http\Requests\Supplier\ShowSupplierRequest;
use App\Repositories\SupplierRepository;
use App\Services\SupplierService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController
{
    private $service;

    private $repository;

    public function __construct(SupplierService $service, SupplierRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $suppliers = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

            return response()->json(['suppliers' => $suppliers], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar fornecedores:', $e, $request);

            return response()->json(['message' => 'Erro ao buscar fornecedores'], 500);
        }
    }

    public function show(ShowSupplierRequest $request)
    {
        try {
            $supplier = $this->repository->findById($request->route('supplierId'));

            return response()->json(['supplier' => $supplier], 200);

        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar fornecedor:', $e, $request);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(CreateSupplierRequest $request)
    {
        try {
            DB::beginTransaction();
            $supplier = $this->service->create($request);
            if ($supplier) {
                DB::commit();

                $suppliers = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['suppliers' => $suppliers, 'message' => 'Fornecedor cadastrado'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar fornecedor:', $e, $request);

            return response()->json(['message' => 'Erro ao cadastrar fornecedor'], 500);
        }
    }

    public function update(UpdateDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $supplier = $this->service->update($request);

            if ($supplier) {
                DB::commit();

                $suppliers = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['suppliers' => $suppliers, 'message' => 'Fornecedor atualizado'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar fornecedor:', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar fornecedor'], 500);
        }
    }

    public function destroy(DeleteSupplierRequest $request)
    {
        try {
            DB::beginTransaction();

            $supplier = $this->repository->delete($request->route('supplierId'));

            if ($supplier) {
                DB::commit();
                $suppliers = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['suppliers' => $suppliers, 'message' => 'Fornecedor excluído'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir fornecedor:', $e, $request);

            return response()->json(['message' => 'Erro ao excluir fornecedor'], 500);
        }
    }
}
