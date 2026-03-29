<?php
namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class AdminUserUpdateRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()->role === User::ROLE_ADMIN; }
    public function rules(): array
    {
        $userId = $this->route('user')?->id ?? $this->route('user');
        return [
            'firstname'           => ['required','string','max:60'],
            'lastname'            => ['required','string','max:60'],
            'email'               => ['required','email','max:60', Rule::unique('users','email')->ignore($userId)],
            'phone'               => ['nullable','string','max:40'],
            'company.name'        => ['required','string','max:255'],
            'company.category'    => ['required','string','max:255'],
            'company.description' => ['nullable','string','max:2000'],
            'company.logo'        => ['nullable','image','mimes:jpeg,png,jpg,webp','max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'email.unique'              => 'This email address is already in use.',
            'company.name.required'     => 'The company name is required.',
            'company.category.required' => 'The company category is required.',
        ];
    }
}