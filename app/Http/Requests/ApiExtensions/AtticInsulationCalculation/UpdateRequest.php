<?php

namespace App\Http\Requests\ApiExtensions\AtticInsulationCalculation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return AbstractRulesMessagesRequest::rules();
    }

    public function messages()
    {
        return AbstractRulesMessagesRequest::messages();
    }
}
