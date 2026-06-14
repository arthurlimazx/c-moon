<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCorpoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'tipo' => ['required', Rule::in(['planeta', 'Lua', 'asteroide', 'cometa', 'estrela', 'nebulosa'])],
            'distancia_terra' => 'required|numeric|min:0',
            'descricao' => 'required|string|max:255',
            'diametro_km' => 'required|numeric|min:0',
            'fotos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'

        ];
    }
}
