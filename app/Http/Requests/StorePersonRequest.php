<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StorePersonRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'first_name' => ['required','string','max:100'],
            'last_name'  => ['required','string','max:100'],
            'avatar'     => ['nullable','image','mimes:jpeg,png,jpg,webp','max:2048'],
            'phone'      => ['nullable','string','max:40'],
            'email'      => ['nullable','email','max:100'],
        ];
    }
}