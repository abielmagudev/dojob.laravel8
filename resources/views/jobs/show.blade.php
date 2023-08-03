@extends('application')
@section('content')
<p class="text-end">
    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Back</a>
</p>
<div class="card border-0 shadow">
    <div class="card-body">
        <h4 class="card-title">{{ $job->name }}</h4>
        <p class="text-body-secondary">{{ $job->description }}</p>
        <br>
        <p>Extensions</p>
        <ul>
            @foreach($job->extensions->sortBy('name') as $extension)
            <li>{{ $extension->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection