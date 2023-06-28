<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class ExtensionLoaderController extends Controller
{
    public function __invoke(Request $request)
    {
        $job = Job::find($request->job);

        $templates = $job->extensions->map(function ($extension) use ($request) {
            return app()->call([new $extension->controller_class, $request->method], $request->all());
        });

        return response()->json([
            'job' => $job->name,
            'method' => $request->method,
            'templates' => $templates,
        ]);
    }
}
