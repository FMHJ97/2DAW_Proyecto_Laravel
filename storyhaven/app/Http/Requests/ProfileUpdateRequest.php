<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'date_birth' => ['required', 'date', 'before_or_equal:' . now()->subYears(12)->format('Y-m-d')], // Se añade la regla 'before_or_equal' para que la fecha de nacimiento sea anterior o igual a 12 años antes de la fecha actual.
            'country' => ['required', 'string', 'in:España,Italia,Portugal,Inglaterra,Francia'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'surname.required' => 'Los apellidos son obligatorios.',
            'date_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_birth.before_or_equal' => 'Debes ser mayor de 12 años.',
            'country.required' => 'El país es obligatorio.',
            'country.in' => 'El país seleccionado no es válido.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'Este correo ya está en uso.',
        ];
    }
}
