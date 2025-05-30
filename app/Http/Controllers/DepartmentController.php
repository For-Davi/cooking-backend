<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CreateDepartmentRequest;
use App\Http\Requests\Auth\UpdateDepartmentRequest;
use App\Http\Requests\DeleteDepartmentRequest;
use App\Repositories\DepartmentRepository;
use App\Services\DepartmentService;
use App\Utils\ErrorLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController
{
    private $service;

    private $repository;

    public function __construct(DepartmentService $service, DepartmentRepository $enterpriseRepository)
    {
        $this->service = $service;
        $this->enterpriseRepository = $enterpriseRepository;
    }

    public function index(Request $request)
    {
        try {
            $departments = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

            return response()->json(['departments' => $departments], 200);
        } catch (\Exception $e) {
            ErrorLogger::log('Erro ao buscar departamentos.', $e, $request);

            return response()->json(['message' => 'Erro ao buscar departamentos'], 500);
        }
    }

    public function store(CreateDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $department = $this->service->create($request);

            if ($department) {
                DB::commit();

                $departments = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['departments' => $departments, 'message' => 'Departamento cadastrado com sucesso'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao cadastrar departamento', $e, $request);

            return response()->json(['message' => 'Erro ao cadastrar departamento'], 500);
        }
    }

    public function update(UpdateDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $department = $this->service->update($request);

            if ($department) {
                DB::commit();

                $departments = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['departments' => $departments, 'message' => 'Departamento atualizado com sucesso'], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao atualizar departamento', $e, $request);

            return response()->json(['message' => 'Erro ao atualizar departamento'], 500);
        }
    }

    public function destroy(DeleteDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();

            $department = $this->repository->delete($request->route('id'));

            if ($department) {
                DB::commit();
                $departments = $this->repository->getAllByEnterprise($request->get('enterprise_id'));

                return response()->json(['departments' => $departments, 'message' => 'Departamento deletado com sucesso'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorLogger::log('Erro ao excluir departamento', $e, $request);

            return response()->json(['message' => 'Erro ao excluir departamento'], 500);
        }
    }
}
