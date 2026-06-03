<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hostel_id' => ['required', 'exists:hostels,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'bed_id' => ['required', 'exists:beds,id'],

            'seeker_id' => ['nullable', 'exists:users,id'],

            'name' => ['required_without:seeker_id'],
            'email' => ['required_without:seeker_id', 'email'],
            'phone' => ['required_without:seeker_id'],
            'cnic' => ['required_without:seeker_id'],

            'check_in_date' => ['required', 'date'],
            'monthly_rent' => ['required', 'numeric'],
        ];
    }
}