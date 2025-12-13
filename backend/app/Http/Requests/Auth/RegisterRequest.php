<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()      // exige letras
                    ->mixedCase()    // exige maiúsculas e minúsculas
                    ->numbers()      // exige números
                    ->symbols()      // exige símbolos
                    // ->uncompromised()// verifica vazamentos (Have I Been Pwned)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max'      => 'O nome deve ter no maximo 100 caracteres',
            
            'email.required' => 'O email é obrigatório.',
            'email.email'    => 'formato de email inválido.',
            'email.unique'   => 'Este email já está em uso.',

            'password.required'      => 'A senha é obrigatória.',
            'password.confirmed'     => 'As senhas não coincidem.',
            'password.min'           => 'A senha deve ter no mínimo 8 caracteres.',
            'password.letters'       => 'A senha deve conter pelo menos uma letra.',
            'password.mixed_case'    => 'A senha deve conter letras maiúsculas e minúsculas.',
            'password.numbers'       => 'A senha deve conter pelo menos um número.',
            'password.symbols'       => 'A senha deve conter pelo menos um símbolo.',
            'password.uncompromised' => 'Essa senha já foi exposta em vazamentos. Escolha outra.',
        ];
    }
}
