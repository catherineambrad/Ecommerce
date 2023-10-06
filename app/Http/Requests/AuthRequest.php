<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
            ];
        } else {
            return [
                'email' => 'required|string',
                'password' => 'required|string'
            ];
        }
    }
    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
            ];
        } else {
            return [
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
            ];
        }
    }
}
