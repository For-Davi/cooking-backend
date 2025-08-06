<?php

namespace App\Http\Requests\Setting\Appearance;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingAppearanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'navbarColorDefault' => 'required|in:0,1',
            'navbarIconColorDefault' => 'required|in:0,1',
            'sideMenuColorDefault' => 'required|in:0,1',
            'sideMenuColorDefaultNotSelectedItem' => 'required|in:0,1',
            'sideMenuColorDefaultSelectedItem' => 'required|in:0,1',
            'sideMenuColorDefaultNotSelectedIcon' => 'required|in:0,1',
            'sideMenuColorDefaultSelectedIcon' => 'required|in:0,1',
            'navbarColorCode' => 'required_if:navbarColorDefault,0|nullable|string|max:7|min:7',
            'navbarIconColorCode' => 'required_if:navbarIconColorDefault,0|nullable|string|max:7|min:7',
            'sideMenuColorCode' => 'required_if:sideMenuColorDefault,0|nullable|string|max:7|min:7',
            'sideMenuColorCodeNotSelectedItem' => 'required_if:sideMenuColorDefaultNotSelectedItem,0|nullable|string|max:7|min:7',
            'sideMenuColorCodeSelectedItem' => 'required_if:sideMenuColorDefaultSelectedItem,0|nullable|string|max:7|min:7',
            'sideMenuColorCodeNotSelectedIcon' => 'required_if:sideMenuColorDefaultNotSelectedIcon,0|nullable|string|max:7|min:7',
            'sideMenuColorCodeSelectedIcon' => 'required_if:sideMenuColorDefaultSelectedIcon,0|nullable|string|max:7|min:7',
        ];
    }

    public function messages(): array
    {
        return [
            'navbarColorDefault.required' => 'Deve ser requerido o campo do toggle',
            'navbarColorDefault.in' => 'O valor do toggle deve ser 0 ou 1',

            'navbarIconColorDefault.required' => 'Deve ser requerido o campo do toggle',
            'navbarIconColorDefault.in' => 'O valor do toggle deve ser 0 ou 1',

            'sideMenuColorDefault.required' => 'Deve ser requerido o campo do toggle',
            'sideMenuColorDefault.in' => 'O valor do toggle deve ser 0 ou 1',

            'sideMenuColorDefaultNotSelectedItem.required' => 'Deve ser requerido o campo do toggle',
            'sideMenuColorDefaultNotSelectedItem.in' => 'O valor do toggle deve ser 0 ou 1',

            'sideMenuColorDefaultSelectedItem.required' => 'Deve ser requerido o campo do toggle',
            'sideMenuColorDefaultSelectedItem.in' => 'O valor do toggle deve ser 0 ou 1',

            'sideMenuColorDefaultNotSelectedIcon.required' => 'Deve ser requerido o campo do toggle',
            'sideMenuColorDefaultNotSelectedIcon.in' => 'O valor do toggle deve ser 0 ou 1',

            'sideMenuColorCodeSelectedIcon.required' => 'Deve ser requerido o campo do toggle',
            'sideMenuColorCodeSelectedIcon.in' => 'O valor do toggle deve ser 0 ou 1',

            'navbarColorCode.string' => 'O código da cor deve ser uma string',
            'navbarColorCode.min' => 'O código da cor deve conter 7 caracteres',
            'navbarColorCode.max' => 'O código da cor deve conter 7 caracteres',

            'navbarIconColorCode.string' => 'O código da cor deve ser uma string',
            'navbarIconColorCode.min' => 'O código da cor deve conter 7 caracteres',
            'navbarIconColorCode.max' => 'O código da cor deve conter 7 caracteres',

            'sideMenuColorCode.string' => 'O código da cor deve ser uma string',
            'sideMenuColorCode.min' => 'O código da cor deve conter 7 caracteres',
            'sideMenuColorCode.max' => 'O código da cor deve conter 7 caracteres',

            'sideMenuColorCodeNotSelectedItem.string' => 'O código da cor deve ser uma string',
            'sideMenuColorCodeNotSelectedItem.min' => 'O código da cor deve conter 7 caracteres',
            'sideMenuColorCodeNotSelectedItem.max' => 'O código da cor deve conter 7 caracteres',

            'sideMenuColorCodeSelectedItem.string' => 'O código da cor deve ser uma string',
            'sideMenuColorCodeSelectedItem.min' => 'O código da cor deve conter 7 caracteres',
            'sideMenuColorCodeSelectedItem.max' => 'O código da cor deve conter 7 caracteres',

            'sideMenuColorCodeNotSelectedIcon.string' => 'O código da cor deve ser uma string',
            'sideMenuColorCodeNotSelectedIcon.min' => 'O código da cor deve conter 7 caracteres',
            'sideMenuColorCodeNotSelectedIcon.max' => 'O código da cor deve conter 7 caracteres',

            'sideMenuColorCodeSelectedIcon.string' => 'O código da cor deve ser uma string',
            'sideMenuColorCodeSelectedIcon.min' => 'O código da cor deve conter 7 caracteres',
            'sideMenuColorCodeSelectedIcon.max' => 'O código da cor deve conter 7 caracteres',

        ];
    }
}
