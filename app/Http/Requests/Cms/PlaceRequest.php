<?php

namespace App\Http\Requests\Cms;

use App\Http\Requests\Request;

class PlaceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'title:th' => 'required',
            // 'description:th' => 'required',
            // 'street:th' => 'required',
            // 'subdistrict:th' => 'required',
            // 'district:th' => 'required',
            // 'province:th' => 'required',
            // 'postcode:th' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }
}
