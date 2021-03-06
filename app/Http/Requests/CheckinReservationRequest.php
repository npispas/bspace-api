<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckinReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191'],
            'nationality' => ['required', 'string', 'max:191'],
            'address' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
            'image' => ['required', 'mimes:jpg,bmp,png']
        ];
    }
}
