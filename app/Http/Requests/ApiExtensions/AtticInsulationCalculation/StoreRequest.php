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
            AtticInsulationCalculation::getWithPrefix('method') => ['required'],
            AtticInsulationCalculation::getWithPrefix('rvalue') => ['required'],
            AtticInsulationCalculation::getWithPrefix('square_feets') => ['required'],
        ];
    }

    public function messages()
    {
        return [
            AtticInsulationCalculation::getWithPrefix('method.required') => __('Method is required'),
            AtticInsulationCalculation::getWithPrefix('rvalue.required') => __('R-Value is required'),
            AtticInsulationCalculation::getWithPrefix('square_feets.required') => __('Square feets is required'),
        ];
    }
}
