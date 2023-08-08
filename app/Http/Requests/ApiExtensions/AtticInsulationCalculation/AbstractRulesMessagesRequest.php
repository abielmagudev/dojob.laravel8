<?php

namespace App\Http\Requests\ApiExtensions\AtticInsulationCalculation;

use App\Models\ApiExtensions\AtticInsulationCalculation;

abstract class AbstractRulesMessagesRequest
{
    public static function rules()
    {
        return [
            AtticInsulationCalculation::concatPrefix('method') => ['required'],
            AtticInsulationCalculation::concatPrefix('rvalue') => ['required'],
            AtticInsulationCalculation::concatPrefix('square_feets') => ['required'],
        ];
    }

    public static function messages()
    {
        return [
            AtticInsulationCalculation::concatPrefix('method.required') => __('Method is required'),
            AtticInsulationCalculation::concatPrefix('rvalue.required') => __('R-Value is required'),
            AtticInsulationCalculation::concatPrefix('square_feets.required') => __('Square feets is required'),
        ];
    }
}
