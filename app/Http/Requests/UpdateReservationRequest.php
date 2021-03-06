<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('update_reservations');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => ['required', 'date'],
            'start_hour' => ['required', 'date_format:H:i:s'],
            'end_date' => ['required', 'date'],
            'end_hour' => ['required', 'date_format:H:i:s'],
            'room' => ['required', 'integer', 'min:1']
        ];
    }
}
