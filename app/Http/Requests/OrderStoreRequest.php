<?php

namespace App\Http\Requests;

use App\Http\Requests\OrderRequests\ExtensionRequestsLoader;
use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public $extensionRequestsLoader;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->extensionRequestsLoader->mergeRules([
            'scheduled_date' => ['required'],
            'scheduled_time' => ['required'],
            'job' => ['required', sprintf('exists:%s,id', \App\Models\Job::class)],
            'notes' => 'nullable',
        ]);
    }

    public function messages()
    {
        return $this->extensionRequestsLoader->mergeMessages([
            'scheduled_date.required' => __('Date is required'),
            'scheduled_time.required' => __('Time is required'),
            'job.required' => __('Job is required'),
            'job.exists' => __('Job is invalid'),
        ]);
    }

    public function prepareForValidation()
    {
        $this->extensionRequestsLoader = new ExtensionRequestsLoader( Job::find($this->job) );

        $this->extensionRequestsLoader->load('StoreRequest');

        /**
         * If job selected has extensions, then:
         * A) Cache job extensions query for next use
         * B) With this you avoid 2 or more subsequent queries
         */
        if( $this->extensionRequestsLoader->hasExtensions() )
        {
            $this->merge([
                'job_extensions_cache' => $this->extensionRequestsLoader->getExtensions(),
            ]);
        }
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'job_id' => $this->input('job'),
        ]);
    }
}

/**
 * Example of passedValidation, can use replace or merge data...
protected function passedValidation()
{
    $this->merge([
        'job_id' => $this->job
    ]);
}

* Example of failedValidation, can use to response with JSON...
protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(
        new JsonResponse([
            'message' => 'Request failed.',
            'errors' => $validator->errors(),
        ], JsonResponse::HTTP_BAD_REQUEST)
    );
}

*/
