<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:40',
            'editora' => 'required|string|max:40',
            'edicao' => 'required|integer',
            'ano_publicacao' => 'required|digits:4',
            'preco' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título deve ter no máximo 40 caracteres.',
            'editora.required' => 'A editora é obrigatória.',
            'editora.max' => 'A editora deve ter no máximo 40 caracteres.',
            'edicao.required' => 'A edição é obrigatória.',
            'edicao.numeric' => 'A edição deve ser um número inteiro.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'ano_publicacao.digits' => 'O ano de publicação deve ter 4 caracteres.',
            'preco.required' => 'O preço é obrigatório.'
        ];
    }
}
