<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|max:255|confirmed',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Vous devez mettre un email',
            'name.required' => 'Vous devez mettre un nom',
            'password.required' => 'Vous devez mettre un mot de passe',
            'name.min' => 'Le nom doit avoir au moins 3 caractères.',
            'email.unique' => "Un autre utilisateur a déjà créé un compte avec cet adresse mail.",
            'email.email' => "Email invalide",
            'password.min' => "Le mot de passe doit avoir au moins 8 caractères.",
            'password.confirmed' => "Les mots de passe ne correpondent pas."
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'name' => 'trim|capitalize'
        ];
    }
}
