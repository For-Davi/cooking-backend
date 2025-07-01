<?php

namespace App\Http\Requests\Grid\Item;

use Illuminate\Foundation\Http\FormRequest;

class ShowAllGridItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gridID' => 'required|exists:grid_groups,id',
        ];
    }

    public function messages(): array
    {
        return [
            'gridID.required' => 'O ID da grade é obrigatório',
            'gridID.exists' => 'O ID da grade informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
