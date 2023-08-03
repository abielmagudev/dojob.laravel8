<?php

namespace App\Http\Requests\ApiExtensions\AtticInsulationCalculation;

use App\Models\ApiExtensions\AtticInsulationCalculation;
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
            AtticInsulationCalculation::concatPrefix('method') => ['required'],
            AtticInsulationCalculation::concatPrefix('rvalue') => ['required'],
            AtticInsulationCalculation::concatPrefix('square_feets') => ['required'],
        ];
    }

    public function messages()
    {
        return [
            AtticInsulationCalculation::concatPrefix('method.required') => __('Method is required'),
            AtticInsulationCalculation::concatPrefix('rvalue.required') => __('R-Value is required'),
            AtticInsulationCalculation::concatPrefix('square_feets.required') => __('Square feets is required'),
        ];
    }
}
