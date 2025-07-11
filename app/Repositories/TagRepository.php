<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{
    public function __construct(protected Tag $model) {}

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllByEnterprise($enterpriseId)
    {
        return $this->model->where('enterprise_id', $enterpriseId)->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $tag = $this->findById($id);
        if ($tag) {
            $tag->update($data);

            return $tag;
        }

        return null;
    }

    public function delete($id)
    {
        $tag = $this->findById($id);
        if ($tag) {

            return $tag->delete();
        }

        return false;
    }
}
