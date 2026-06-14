<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMissaoRequest extends FormRequest
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
            'corpo_celeste_id' => 'required|exists:corpos,id',
            'data_lancamento' => 'required|date',
            'status' => ['required', Rule::in(['planejada', 'em andamento', 'concluída'])],
            'astronautas' => 'required|array',
            'data_retorno' => 'required|date|after_or_equal:data_lancamento',
            'descricao' => 'nullable|string|max:255',
            'astronautas.*' => 'exists:astronautas,id',
            'fotos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
