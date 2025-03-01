<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelatoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cualquiera puede hacer la petición.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:100', // El título es obligatorio y tiene un máximo de 100 caracteres.
            'resumen' => 'required|string|max:300', // El resumen es obligatorio y tiene un máximo de 300 caracteres.
            'contenido_pdf' => 'file|mimes:pdf', // El contenido debe ser un archivo PDF.
            'generos' => 'required|array|min:1|max:4', // Se deben seleccionar entre 1 y 4 géneros.
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no puede tener más de 100 caracteres.',
            'resumen.required' => 'El resumen es obligatorio.',
            'resumen.string' => 'El resumen debe ser una cadena de texto.',
            'resumen.max' => 'El resumen no puede tener más de 300 caracteres.',
            'contenido_pdf.file' => 'El contenido debe ser un archivo.',
            'contenido_pdf.mimes' => 'El contenido debe ser un archivo PDF.',
            'generos.required' => 'Debes seleccionar al menos un género literario.',
            'generos.array' => 'Los géneros deben ser un array.',
            'generos.min' => 'Debes seleccionar al menos un género literario.',
            'generos.max' => 'No puedes seleccionar más de cuatro géneros literarios.',
        ];
    }
}
