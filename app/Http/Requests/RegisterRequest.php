<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'min:4', 'max:20'],
            'phonenumber' => ['required', 'string', 'max:20'],
        ];
    }
}
