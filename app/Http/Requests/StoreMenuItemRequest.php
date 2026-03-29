<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'section_id'       => ['nullable', 'integer', 'exists:menu_sections,id'],
            'name'             => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string', 'max:1000'],
            'price'            => ['required', 'numeric', 'min:0', 'max:99999.99'],
            'photo'            => ['nullable', 'image', 'max:2048'],
            'is_halal'         => ['boolean'],
            'is_vegetarian'    => ['boolean'],
            'is_vegan'         => ['boolean'],
            'is_gluten_free'   => ['boolean'],
            'is_spicy'         => ['boolean'],
            'is_featured'      => ['boolean'],
            'is_new'           => ['boolean'],
            'preparation_time' => ['nullable', 'integer', 'min:1', 'max:300'],
            'sort_order'       => ['nullable', 'integer', 'min:0'],
        ];
    }
}
