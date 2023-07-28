<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class JobExtensionsRequest extends FormRequest
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
            'job'    => ['bail','required',sprintf('exists:%s,id', \App\Models\Job::class)],
            'method' => ['bail','required','in:create,edit'],
            'order'  => ['bail','required_if:method,edit', sprintf('exists:%s,id', \App\Models\Order::class)],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            new JsonResponse([
                'message' => 'Request failed.',
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_BAD_REQUEST)
        );
    }
}
