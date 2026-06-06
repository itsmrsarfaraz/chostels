<?php

namespace App\Http\Requests\Seeker;

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

            'hostel_id' => [
                'required',
                'exists:hostels,id'
            ],

            'room_id' => [
                'required',
                'exists:rooms,id'
            ],

            'bed_id' => [
                'required',
                'exists:beds,id'
            ],

            'check_in_date' => [
                'required',
                'date'
            ],

            'monthly_rent' => [
                'required',
                'numeric'
            ],
        ];
    }
}