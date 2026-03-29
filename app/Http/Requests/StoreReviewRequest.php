<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'author_name'  => ['required','string','max:100'],
            'rating'       => ['required','integer','min:1','max:5'],
            'content'      => ['nullable','string','max:2000'],
            'reply'        => ['nullable','string','max:2000'],
            'is_published' => ['boolean'],
        ];
    }
}