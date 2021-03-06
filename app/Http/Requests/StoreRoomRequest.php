<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('create_rooms');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:100'],
            'interior_size' => ['required', 'integer', 'min:10'],
            'min_occupancy' => ['required', 'integer', 'min:1'],
            'max_occupancy' => ['required', 'integer', 'min:1'],
            'available_from' => ['required', 'date'],
            'available_to' => ['required', 'date'],
            'room_type_id' => ['required', 'integer'],
            'is_published' => ['required', 'integer', 'min:0', 'max:1'],
            'description' => ['required', 'string', 'max:191'],
            'images.*' => ['sometimes', 'mimes:jpg,bmp,png']
        ];
    }
}
