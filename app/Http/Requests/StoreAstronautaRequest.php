<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAstronautaRequest extends FormRequest
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
            'nacionalidade' => 'required|string|max:255',
            'especialidade' => 'required|string|max:255',
            'num_missoes' => 'required|integer|min:0',
            'status' => ['required', Rule::in(['ativo', 'inativo', 'aposentado'])],
            'fotos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
