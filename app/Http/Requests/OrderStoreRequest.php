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

        $extra = [];

        foreach($this->form_requests as $form_request)
            array_push($extra, $form_request->rules());

        return array_merge($rules, ...$extra);
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
            if(! isset($extension->info->classname) )
                continue;

            $form_request_store = __NAMESPACE__ . '\\ApiExtensions\\' . $extension->info->classname . '\\StoreRequest';

            if(! class_exists($form_request_store) )
                continue;

            array_push($this->form_requests, (new $form_request_store));
        }
    }
}
