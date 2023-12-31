<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.index')->with('jobs', 
            Job::withCount(['extensions','orders'])
            ->orderBy('name')
            ->get()
        );
    }

    public function create()
    {
        return view('jobs.create')->with('job', new Job);
    }

    public function store(Request $request)
    {
        if(! $job = Job::create($request->all()) )
            return back()->with('danger', 'Job was not created, please try again');

        return redirect()->route('jobs.index')->with('success', "Job <b>{$job->name}</b> created");
    }

    public function show(Job $job)
    {
        return view('jobs.show')->with('job', $job->load('extensions'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'extensions' => Extension::all()->sortBy('name'),
            'job' => $job,
        ]);
    }

    public function update(Request $request, Job $job)
    {
        if(! $job->fill($request->all())->save() )
            return back()->with('danger', 'Job was not updated, please try again'); 

        $job->extensions()->sync($request->get('extensions', []));

        return redirect()->route('jobs.edit', $job)->with('success', "Job <b>{$job->name}</b> updated");
    }

    public function destroy(Job $job)
    {
        if(! $job->delete() )
            return back()->with('danger', 'Job was not deleted, please try again');

        return redirect()->route('jobs.index')->with('success', "Job <b>{$job->name}</b> deleted");
    }
}
