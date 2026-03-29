<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateBookingRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'full_name'    => ['required','string','max:255'],
            'phone'        => ['nullable','string','max:30'],
            'email'        => ['nullable','email','max:255'],
            'party_size'   => ['required','integer','min:1','max:100'],
            'booking_date' => ['required','date'],
            'booking_time' => ['required','date_format:H:i'],
            'status'       => ['required','in:pending,confirmed,cancelled,completed'],
            'source'       => ['nullable','in:online,phone,walk-in,platform'],
            'notes'        => ['nullable','string','max:1000'],
        ];
    }
    public function messages(): array
    {
        return [
            'status.in'                => 'Invalid status value.',
            'booking_time.date_format' => 'Please enter a valid time (HH:MM).',
        ];
    }
}