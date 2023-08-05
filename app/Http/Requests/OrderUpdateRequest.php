<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    public $form_requests = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'scheduled_date' => ['required'],
            'scheduled_time' => ['required'],
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
        ];

        foreach($this->form_requests as $form_request)
            $messages = array_merge($messages, $form_request->messages());

        return $messages;
    }

    public function prepareForValidation()
    {
        if(! $this->route('order')->job->hasExtensions() )
            return;

        foreach($this->route('order')->job->extensions as $extension)
        {
            $form_request_class = $extension->getFormRequestClass('StoreRequest');
            array_push($this->form_requests, (new $form_request_class));
        }

        // Cache the extensions of job, to avoid 2 subsequent queries 
        $this->merge([
            'job_extensions_cache' => $this->route('order')->job->extensions,
        ]);
    }
}
