<?php

namespace App\Http\Requests\Grid\Item;

use Illuminate\Foundation\Http\FormRequest;

class ShowGridItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'itemID' => 'required|exists:grid_itens,id',
        ];
    }

    public function messages(): array
    {
        return [
            'itemID.required' => 'O ID do item da grade é obrigatório',
            'itemID.exists' => 'O ID do item da grade informado não existe.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
}
