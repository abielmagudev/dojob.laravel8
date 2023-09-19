<?php

namespace App\Http\Requests\OrderRequests;

use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

class ExtensionRequestsLoader
{
    private $cache = [];

    public function __construct($job)
    {
        if( is_a($job, Job::class) && $job->hasExtensions() )
        {
            $this->setCache('extensions', $job->extensions);
        }
    }


    // Cache 

    public function __get($name)
    {
        return $this->hasCache($name) ? $this->getCache($name) : null;
    }

    private function setCache($key, $value)
    {
        return $this->cache[$key] = $value;
    }

    private function hasCache($key)
    {
        return array_key_exists($key, $this->cache);
    }

    private function getCache($key)
    {
        return $this->cache[$key];
    }


    // Extensions

    public function hasExtensions()
    {
        return is_a($this->extensions, Collection::class);
    }

    public function getExtensions()
    {
        return $this->extensions ?? Collection::make([]);
    }


    // Requests

    public function load($name)
    {
        $requests_filtered = $this->getExtensions()->map(function ($extension) use ($name) {
            
            $formRequestClass = $extension->getFormRequest($name);
            
            return class_exists($formRequestClass) ? new $formRequestClass : null;

        })->filter();

        $this->setCache('requests', $requests_filtered);

        return $this;
    }

    public function requests()
    {
        return $this->requests ?? Collection::make([]);
    }


    // Rules

    public function rules()
    {
        return $this->requests()->map(function ($request) {
            return $request->rules();
        })->toArray();
    }

    public function mergeRules(array $rules)
    {
        return array_merge($rules, ...$this->rules());
    }


    // Messages 

    public function messages()
    {
        return $this->requests()->map(function ($request) {
            return $request->messages();
        })->toArray();
    }

    public function mergeMessages(array $messages)
    {
        return array_merge($messages, ...$this->messages());
    }
}
