<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarIndexRequest extends FormRequest
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
                'string',
                'min:2',
                'max:255',
            ],
            'brand_name' => ['string', 'min:2', 'max:255'],
            'year' => ['date_format:Y', 'after_or_equal:1945-01-01']
        ];
    }
}
