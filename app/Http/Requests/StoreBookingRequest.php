<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'full_name'    => ['required','string','max:255'],
            'phone'        => ['nullable','string','max:30'],
            'email'        => ['nullable','email','max:255'],
            'party_size'   => ['required','integer','min:1','max:100'],
            'booking_date' => ['required','date','after_or_equal:today'],
            'booking_time' => ['required','date_format:H:i'],
            'source'       => ['nullable','in:online,phone,walk-in,platform'],
            'notes'        => ['nullable','string','max:1000'],
        ];
    }
    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            if (empty($this->phone) && empty($this->email)) {
                $v->errors()->add('phone', 'Please provide at least a phone number or email address.');
            }
        });
    }
    public function messages(): array
    {
        return [
            'booking_date.after_or_equal' => 'The booking date must be today or a future date.',
            'booking_time.date_format'    => 'Please enter a valid time (HH:MM).',
        ];
    }
}