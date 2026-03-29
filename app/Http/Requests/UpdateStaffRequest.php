<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateStaffRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'function_id' => ['nullable','integer','exists:staff_functions,id'],
            'first_name'  => ['required','string','max:100'],
            'last_name'   => ['required','string','max:100'],
            'phone'       => ['nullable','string','max:30'],
            'email'       => ['nullable','email','max:255'],
            'avatar'      => ['nullable','image','mimes:jpeg,png,jpg,webp','max:2048'],
            'hire_date'   => ['nullable','date','before_or_equal:today'],
            'notes'       => ['nullable','string','max:1000'],
            'sort_order'  => ['nullable','integer','min:0'],
            'is_active'   => ['boolean'],
        ];
    }
}