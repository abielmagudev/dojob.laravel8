<?php

namespace App\Http\Requests\ApiExtensions\Weatherization;

use App\Models\ApiExtensions\Weatherization;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            Weatherization::prefix('products') => [
                'required',
                'array'
            ],
            Weatherization::prefix('quantities') => [
                'required',
                'array'
            ],
        ];
    }

    public function messages()
    {
        return [
            Weatherization::prefix('products.required') => __('Products required'),
            Weatherization::prefix('products.array') => __('Choose a valid product'),
            Weatherization::prefix('quantities.required') => __('Quantities required'),
            Weatherization::prefix('quantities.array') => __('Write a valid quantity'),
        ];
    }   
}
