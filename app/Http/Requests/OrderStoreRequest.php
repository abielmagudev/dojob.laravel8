<?php

namespace App\Http\Requests;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\OrderRequestsFeatures\HasJobExtensionsCache;
use App\Http\Requests\OrderRequestsFeatures\HasJobExtensionsRequests;

class OrderStoreRequest extends FormRequest
{
    use HasJobExtensionsCache;
    use HasJobExtensionsRequests;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->mergeExtensionFormRequestRules([
            'scheduled_date' => ['required'],
            'scheduled_time' => ['required'],
            'job' => ['required', sprintf('exists:%s,id', \App\Models\Job::class)],
            'notes' => 'nullable',
        ]);
    }

    public function messages()
    {
        return $this->mergeExtensionFormRequestMessages([
            'scheduled_date.required' => __('Date is required'),
            'scheduled_time.required' => __('Time is required'),
            'job.required' => __('Job is required'),
            'job.exists' => __('Job is invalid'),
        ]);
    }

    public function prepareForValidation()
    {
        $job = Job::find($this->job);

        if( is_null($job) ||! $job->hasExtensions() )
            return;

        $this->loadExtensionFormRequests($job->extensions, 'StoreRequest');
        $this->cacheExtensions($job->extensions);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'job_id' => $this->input('job'),
        ]);
    }

    /**
     * Example of passedValidation, can use replace or merge data...
     * 
     * 
     
        protected function passedValidation()
        {
            $this->merge([
                'job_id' => $this->job
            ]);
        }

     * Example of failedValidation, can use to response with JSON...
     * 
     * 
     
        protected function failedValidation(Validator $validator)
        {
            throw new HttpResponseException(
                new JsonResponse([
                    'message' => 'Request failed.',
                    'errors' => $validator->errors(),
                ], JsonResponse::HTTP_BAD_REQUEST)
            );
        }

     *
     * 
     */
}
