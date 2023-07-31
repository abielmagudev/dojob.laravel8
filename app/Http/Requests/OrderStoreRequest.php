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
            'job' => ['required'],
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
    }
}
