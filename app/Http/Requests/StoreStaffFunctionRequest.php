<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreStaffFunctionRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'name'  => ['required','string','max:100'],
            'color' => ['nullable','string','regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }
    public function messages(): array
    {
        return ['color.regex' => 'Please enter a valid hex color (e.g. #0d6efd).'];
    }
}