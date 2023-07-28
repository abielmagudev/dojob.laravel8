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
            'job'    => ['bail', 'required', sprintf('exists:%s,id', \App\Models\Job::class)],
            'method' => ['bail', 'required', 'in:create,edit'],
            'order'  => ['bail', 'nullable', 'required_if:method,edit', sprintf('exists:%s,id', \App\Models\Order::class)],
        ];
    }

    public function messages()
    {
        return [
            'job.required' => __('Job not present'),
            'job.exists' => __('Job not exists'),
            'method.required' => __('Method not present'),
            'method.in' => __('Method not valid'),
            'order.required_if' => __('Order not valid'),
            'order.exists' => __('Order not exists'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // dd($validator->errors());
        throw new HttpResponseException(
            new JsonResponse([
                'message' => 'Request failed.',
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_BAD_REQUEST)
        );
    }
}
