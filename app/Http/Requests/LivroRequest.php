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
            'ano_publicacao' => 'required|integer|max:4|min:4',
            'preco' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
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
            'ano_publicacao.numeric' => 'O ano de publicação deve ser um número inteiro.',
            'ano_publicacao.max' => 'O ano de publicação deve ter no máximo 4 caracteres.',
            'ano_publicacao.min' => 'O ano de publicação deve ser no mínimo 4 caracteres.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser um número.',
            'preco.regex' => 'O preço deve ser um número decimal com até duas casas decimais.',
        ];
    }
}
