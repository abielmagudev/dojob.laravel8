<?php

namespace App\Http\Requests\OrderRequestFeatures;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

trait HasJobExtensionsRequests
{
    public $extensions_form_requests = [];

    public function loadExtensionFormRequests(Collection $extensions, string $form_request_name)
    {
        foreach($extensions as $extension)
        {
            $form_request_class = $extension->getFormRequestClass($form_request_name);

            if( class_exists($form_request_class) )
                $this->addExtensionFormRequest( new $form_request_class );
        }
    }

    public function addExtensionFormRequest(FormRequest $formRequest)
    {
        array_push($this->extensions_form_requests, $formRequest);
    }

    public function mergeExtensionFormRequestRules(array $rules)
    {
        $extensions_rules = [];

        foreach($this->extensions_form_requests as $formRequest)
            array_push($extensions_rules, $formRequest->rules());

        return array_merge($rules, ...$extensions_rules);
    }

    public function mergeExtensionFormRequestMessages(array $messages)
    {
        $extensions_messages = [];

        foreach($this->extensions_form_requests as $formRequest)
            array_push($extensions_messages, $formRequest->messages());

        return array_merge($messages, ...$extensions_messages);
    }
}
