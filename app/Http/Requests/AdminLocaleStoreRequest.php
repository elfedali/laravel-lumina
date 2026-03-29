<?php
namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
class AdminLocaleStoreRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()->role === User::ROLE_ADMIN; }
    public function rules(): array
    {
        return [
            "company_id" => ["required","integer","exists:companies,id"],
            "name"        => ["nullable","string","max:100"],
            "description" => ["nullable","string","max:2000"],
            "address"     => ["required","string","max:100"],
            "city"        => ["required","string","max:60"],
            "neighborhood"=> ["required","string","max:100"],
            "country"     => ["nullable","string","max:60"],
            "zip"         => ["nullable","string","max:20"],
            "phone"       => ["required","string","max:50"],
            "phone2"      => ["nullable","string","max:50"],
            "email"       => ["nullable","email","max:50"],
            "website"     => ["nullable","url","max:255"],
            "instagram"   => ["nullable","string","max:100"],
            "facebook"    => ["nullable","string","max:100"],
            "cover"       => ["nullable","image","mimes:jpeg,png,jpg,webp","max:4096"],
            "capacity"    => ["nullable","integer","min:1","max:9999"],
            "is_primary"  => ["boolean"],
            "is_active"   => ["boolean"],
            "hours"       => ["nullable","array"],
            "hours.*.open" => ["boolean"],
            "hours.*.start"=> ["nullable","date_format:H:i"],
            "hours.*.end"  => ["nullable","date_format:H:i"],
        ];
    }
    public function messages(): array
    {
        return [
            "company_id.required"    => "Please select a company.",
            "company_id.exists"      => "The selected company does not exist.",
            "phone.required"         => "A phone number is required.",
            "address.required"       => "An address is required.",
            "city.required"          => "A city is required.",
            "neighborhood.required"  => "A neighborhood is required.",
            "website.url"            => "Please enter a valid URL.",
            "cover.max"              => "Cover image may not exceed 4 MB.",
        ];
    }
}