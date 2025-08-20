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
            'titlePageColorDefault' => 'required|in:0,1',
            'navbarColorDefault' => 'required|in:0,1',
            'navbarIconColorDefault' => 'required|in:0,1',
            'sideMenuColorDefaultNotSelectedItem' => 'required|in:0,1',
            'sideMenuColorDefaultSelectedItem' => 'required|in:0,1',
            'sideMenuColorDefaultNotSelectedIcon' => 'required|in:0,1',
            'sideMenuColorDefaultSelectedIcon' => 'required|in:0,1',
            'titlePageColorCode' => 'required_if:titlePageColorDefault,0|nullable|string|max:7|min:7',
            'navbarColorCode' => 'required_if:navbarColorDefault,0|nullable|string|max:7|min:7',
            'navbarIconColorCode' => 'required_if:navbarIconColorDefault,0|nullable|string|max:7|min:7',
            'sideMenuColorCodeNotSelectedItem' => 'required_if:sideMenuColorDefaultNotSelectedItem,0|nullable|string|max:7|min:7',
            'sideMenuColorCodeSelectedItem' => 'required_if:sideMenuColorDefaultSelectedItem,0|nullable|string|max:7|min:7',
            'sideMenuColorCodeNotSelectedIcon' => 'required_if:sideMenuColorDefaultNotSelectedIcon,0|nullable|string|max:7|min:7',
            'sideMenuColorCodeSelectedIcon' => 'required_if:sideMenuColorDefaultSelectedIcon,0|nullable|string|max:7|min:7',
        ];
    }

    public function messages(): array
    {
        return [
            'titlePageColorDefault.required' => 'Deve ser requerido o campo do toggle de título',
            'titlePageColorDefault.in' => 'O valor do toggle de título deve ser 0 ou 1',

            'navbarColorDefault.required' => 'Deve ser requerido o campo do toggle da navbar',
            'navbarColorDefault.in' => 'O valor do toggle da navbar deve ser 0 ou 1',

            'navbarIconColorDefault.required' => 'Deve ser requerido o campo do toggle dos ícones da navbar',
            'navbarIconColorDefault.in' => 'O valor do toggle dos ícones da navbar deve ser 0 ou 1',

            'sideMenuColorDefaultNotSelectedItem.required' => 'Deve ser requerido o campo do toggle de itens não selecionados',
            'sideMenuColorDefaultNotSelectedItem.in' => 'O valor do toggle de itens não selecionados deve ser 0 ou 1',

            'sideMenuColorDefaultSelectedItem.required' => 'Deve ser requerido o campo do toggle de itens selecionados',
            'sideMenuColorDefaultSelectedItem.in' => 'O valor do toggle de itens selecionados deve ser 0 ou 1',

            'sideMenuColorDefaultNotSelectedIcon.required' => 'Deve ser requerido o campo do toggle de ícones não selecionados',
            'sideMenuColorDefaultNotSelectedIcon.in' => 'O valor do toggle de ícones não selecionados deve ser 0 ou 1',

            'sideMenuColorDefaultSelectedIcon.required' => 'Deve ser requerido o campo do toggle de ícones selecionados',
            'sideMenuColorDefaultSelectedIcon.in' => 'O valor do toggle de ícones selecionados deve ser 0 ou 1',

            // mensagens para required_if
            'titlePageColorCode.required_if' => 'O código da cor do título é obrigatório quando o toggle de título estiver desativado.',
            'navbarColorCode.required_if' => 'O código da cor da navbar é obrigatório quando o toggle da navbar estiver desativado.',
            'navbarIconColorCode.required_if' => 'O código da cor dos ícones da navbar é obrigatório quando o toggle de ícones da navbar estiver desativado.',
            'sideMenuColorCodeNotSelectedItem.required_if' => 'O código da cor de itens não selecionados é obrigatório quando o toggle de itens não selecionados estiver desativado.',
            'sideMenuColorCodeSelectedItem.required_if' => 'O código da cor de itens selecionados é obrigatório quando o toggle de itens selecionados estiver desativado.',
            'sideMenuColorCodeNotSelectedIcon.required_if' => 'O código da cor de ícones não selecionados é obrigatório quando o toggle de ícones não selecionados estiver desativado.',
            'sideMenuColorCodeSelectedIcon.required_if' => 'O código da cor de ícones selecionados é obrigatório quando o toggle de ícones selecionados estiver desativado.',

            // mensagens de validação de formato/tamanho
            'titlePageColorCode.string' => 'O código da cor de título deve ser uma string',
            'titlePageColorCode.min' => 'O código da cor de título deve conter 7 caracteres',
            'titlePageColorCode.max' => 'O código da cor de título deve conter 7 caracteres',

            'navbarColorCode.string' => 'O código da cor do navbar deve ser uma string',
            'navbarColorCode.min' => 'O código da cor do navbar deve conter 7 caracteres',
            'navbarColorCode.max' => 'O código da cor do navbar deve conter 7 caracteres',

            'navbarIconColorCode.string' => 'O código da cor de ícones do navbar deve ser uma string',
            'navbarIconColorCode.min' => 'O código da cor de ícones do navbar deve conter 7 caracteres',
            'navbarIconColorCode.max' => 'O código da cor de ícones do navbar deve conter 7 caracteres',

            'sideMenuColorCodeNotSelectedItem.string' => 'O código da cor de itens não selecionados deve ser uma string',
            'sideMenuColorCodeNotSelectedItem.min' => 'O código da cor de itens não selecionados deve conter 7 caracteres',
            'sideMenuColorCodeNotSelectedItem.max' => 'O código da cor de itens não selecionados deve conter 7 caracteres',

            'sideMenuColorCodeSelectedItem.string' => 'O código da cor de itens selecionados deve ser uma string',
            'sideMenuColorCodeSelectedItem.min' => 'O código da cor de itens selecionados deve conter 7 caracteres',
            'sideMenuColorCodeSelectedItem.max' => 'O código da cor de itens selecionados deve conter 7 caracteres',

            'sideMenuColorCodeNotSelectedIcon.string' => 'O código da cor de ícones não selecionados deve ser uma string',
            'sideMenuColorCodeNotSelectedIcon.min' => 'O código da cor de ícones não selecionados deve conter 7 caracteres',
            'sideMenuColorCodeNotSelectedIcon.max' => 'O código da cor de ícones não selecionados deve conter 7 caracteres',

            'sideMenuColorCodeSelectedIcon.string' => 'O código da cor de ícones selecionados deve ser uma string',
            'sideMenuColorCodeSelectedIcon.min' => 'O código da cor de ícones selecionados deve conter 7 caracteres',
            'sideMenuColorCodeSelectedIcon.max' => 'O código da cor de ícones selecionados deve conter 7 caracteres',
        ];
    }
}
