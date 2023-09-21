<?php

namespace App\Http\Requests;

use App\Http\Requests\OrderRequests\ExtensionRequestsLoader;
use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'notes' => 'nullable',
        ]);
    }

    public function messages()
    {
        return $this->extensionRequestsLoader->mergeMessages([
            'scheduled_date.required' => __('Date is required'),
            'scheduled_time.required' => __('Time is required'),
        ]);
    }

    public function prepareForValidation()
    {
        $job = $this->route('order')->job;

        $this->extensionRequestsLoader = new ExtensionRequestsLoader($job);

        $this->extensionRequestsLoader->load('UpdateRequest');

        /**
         * If job selected has extensions, then:
         * A) Cache job extensions query for next use
         * B) With this you avoid 2 or more subsequent queries
         */
        if( $job->hasExtensions() )
        {
            $this->merge([
                'job_extensions_cache' => $job->extensions,
            ]);
        }
    }
}
