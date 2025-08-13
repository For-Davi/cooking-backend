<?php

namespace App\Repositories;

use App\Models\Movement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MovementRepository
{
    public function __construct(protected Movement $model) {}

    public function getAllByEnterprise($enterpriseID, $onlyPeriodActual = false)
    {
        $query = $this->model->where('enterprise_id', $enterpriseID);

        if ($onlyPeriodActual) {
            $now = Carbon::now('America/Sao_Paulo');
            $month = str_pad($now->month, 2, '0', STR_PAD_LEFT);
            $year = $now->year;

            $query->where(DB::raw('SUBSTRING(`date`, 4, 2)'), '=', $month)
                ->where(DB::raw('SUBSTRING(`date`, 7, 4)'), '=', $year);
        }

        return $query->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function getAllWithFilter($filters)
    {
        $query = $this->model->where('enterprise_id', $filters->enterpriseID);

        if ($filters->category !== null) {
            $query->where('transaction_category_id', $filters->category);
        }

        if (! empty($filters->startDate)) {
            $start = '01/'.$filters->startDate;
            $query->where(
                DB::raw("STR_TO_DATE(`date`, '%d/%m/%Y')"),
                '>=',
                DB::raw("STR_TO_DATE('$start', '%d/%m/%Y')")
            );
        }

        if (! empty($filters->endDate)) {
            [$month, $year] = explode('/', $filters->endDate);
            $lastDay = cal_days_in_month(CAL_GREGORIAN, (int) $month, (int) $year);
            $end = str_pad($lastDay, 2, '0', STR_PAD_LEFT).'/'.$filters->endDate;

            $query->where(
                DB::raw("STR_TO_DATE(`date`, '%d/%m/%Y')"),
                '<=',
                DB::raw("STR_TO_DATE('$end', '%d/%m/%Y')")
            );
        }

        if ($filters->type !== 'all') {
            $query->where('type', $filters->type);
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $movement = $this->findById($id);
        if ($movement) {
            $movement->update($data);

            return $movement;
        }

        return null;
    }

    public function delete($id)
    {
        $movement = $this->findById($id);

        if ($movement) {
            return $movement->delete();
        }

        return false;
    }
}
