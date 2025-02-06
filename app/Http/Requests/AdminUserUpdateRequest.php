<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AdminUserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    { // if the user is not an admin, return false
        return $this->user()->role === User::ROLE_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',

            'phone' => 'required|string|max:255',

            'company.name' => 'required|string|max:255',
            'company.category' => 'required|string|max:255',
            'company.logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
