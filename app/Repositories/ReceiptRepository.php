<?php

namespace App\Repositories;

use App\Models\Receipt;

class ReceiptRepository
{
    public function __construct(protected Receipt $model) {}

    public function getAllByEnterprise($enterpriseId)
    {
        return $this->model->where('enterprise_id', $enterpriseId)->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $receipt = $this->findById($id);
        if ($receipt) {
            $receipt->update($data);

            return $receipt;
        }

        return null;
    }

    public function delete($id)
    {
        $receipt = $this->findById($id);

        if ($receipt) {
            return $receipt->delete();
        }

        return false;
    }
}
