<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobExtensionsRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobExtensionsController extends Controller
{
    public function __invoke(JobExtensionsRequest $request)
    {
        $job = Job::find($request->job);

        $templates = $job->extensions->map(function ($extension) use ($request) {
            $controller = [new $extension->controller_class, $request->method];
            $parameters = [$request];
            return app()->call($controller, $parameters);
        });

        return response()->json([
            'templates' => $templates
        ]);
    }
}
