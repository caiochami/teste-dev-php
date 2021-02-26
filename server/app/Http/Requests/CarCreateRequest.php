<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarCreateRequest extends FormRequest
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
            'model' => [
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'brand_id' => ['required', 'integer', Rule::exists('brands', 'id')],
            'year' => ['required',  'date_format:Y', 'after_or_equal:1945-01-01']
        ];
    }
}
