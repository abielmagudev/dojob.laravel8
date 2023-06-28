<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.index')->with('jobs', Job::withCount(['extensions','orders'])->orderBy('name')->get());
    }

    public function create()
    {
        return view('jobs.create')->with('job', new Job);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Job $job)
    {
        return view('jobs.show')->with('job', $job->load('extensions.api'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'job' => $job,
            'extensions' => Extension::all(),
        ]);
    }

    public function update(Request $request, Job $job)
    {
        $job->fill($request->all())->save();

        $job->extensions()->sync($request->get('extensions', []));

        return redirect()->route('jobs.edit', $job)->with('success', 'Job updated');
    }

    public function destroy(Job $job)
    {
        //
    }
}
