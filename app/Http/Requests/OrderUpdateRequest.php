<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Order\HasJobExtensionsCache;
use App\Http\Requests\Order\HasJobExtensionsRequests;

class OrderUpdateRequest extends FormRequest
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
            'notes' => 'nullable',
        ]);
    }

    public function messages()
    {
        return $this->mergeExtensionFormRequestMessages([
            'scheduled_date.required' => __('Date is required'),
            'scheduled_time.required' => __('Time is required'),
        ]);
    }

    public function prepareForValidation()
    {
        $job = $this->route('order')->job;

        if( is_null($job) ||! $job->hasExtensions() )
            return;

        $this->loadExtensionFormRequests($job->extensions, 'UpdateRequest');
        $this->cacheExtensions($job->extensions);
    }
}
