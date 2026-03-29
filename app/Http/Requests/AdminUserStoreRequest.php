<?php
namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
class AdminUserStoreRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()->role === User::ROLE_ADMIN; }
    public function rules(): array
    {
        return [
            'firstname'           => ['required','string','max:60'],
            'lastname'            => ['required','string','max:60'],
            'email'               => ['required','email','max:60','unique:users,email'],
            'phone'               => ['nullable','string','max:40'],
            'password'            => ['required','string','min:8','max:255'],
            'company.name'        => ['required','string','max:255'],
            'company.category'    => ['required','string','max:255'],
            'company.description' => ['nullable','string','max:2000'],
            'company.logo'        => ['nullable','image','mimes:jpeg,png,jpg,webp','max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'email.unique'              => 'This email address is already registered.',
            'password.min'              => 'The password must be at least 8 characters.',
            'company.name.required'     => 'The company name is required.',
            'company.category.required' => 'The company category is required.',
        ];
    }
}