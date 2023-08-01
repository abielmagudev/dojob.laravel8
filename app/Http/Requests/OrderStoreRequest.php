<?php

namespace App\Http\Requests;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public $form_requests = [];

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
        $rules = [
            'scheduled_date' => ['required'],
            'scheduled_time' => ['required'],
            'job' => ['required', sprintf('exists:%s,id', \App\Models\Job::class)],
            'notes' => 'nullable',
        ];

        foreach($this->form_requests as $form_request)
            $rules = array_merge($rules, $form_request->rules());

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'scheduled_date.required' => __('Date is required'),
            'scheduled_time.required' => __('Time is required'),
            'job.required' => __('Job is required'),
            'job.exists' => __('Job is invalid'),
        ];

        foreach($this->form_requests as $form_request)
            $messages = array_merge($messages, $form_request->messages());

        return $messages;
    }

    public function prepareForValidation()
    {
        if(! $job = Job::find($this->job) )
            return;

        foreach($job->extensions as $extension)
        {
            $form_request_class = $extension->getFormRequestClass('StoreRequest');
            array_push($this->form_requests, (new $form_request_class));
        }

        // Cache the extensions of job, to avoid 2 subsequent queries 
        $this->merge([
            'job_extensions_cache' => $job->extensions,
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'job_id' => $this->input('job'),
        ]);
    }

    /*
    // Example of passedValidation, can use replace or merge data...

    protected function passedValidation()
    {
        $this->merge([
            'job_id' => $this->job
        ]);
    }
    */
}
