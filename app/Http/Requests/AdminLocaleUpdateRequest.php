<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AdminLocaleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            //  'company_id' => 'nullable|integer|exists:companies,id',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'phone2' => 'nullable|string|max:255',

            'hours' => 'required|array',
            'hours.*.open' => 'required|boolean',
            'hours.*.start' => 'required_if:hours.*.open,true|date_format:H:i',
            'hours.*.end' => 'required_if:hours.*.open,true|date_format:H:i|after:hours.*.start',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'hours.*.start.required_if' => 'Le champ de début est requis lorsque le jour est ouvert.',
            'hours.*.end.required_if' => 'Le champ de fin est requis lorsque le jour est ouvert.',
            'hours.*.end.after' => 'Le champ de fin doit être une date postérieure au champ de début.',
        ];
    }
}
