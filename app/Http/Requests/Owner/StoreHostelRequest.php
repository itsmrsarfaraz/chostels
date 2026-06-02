<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class StoreHostelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'description' => ['nullable'],
            'logo' => ['nullable', 'image'],
        ];
    }
}