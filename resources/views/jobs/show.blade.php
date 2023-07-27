@extends('application')
@section('content')
<p class="text-end">
    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Back</a>
</p>
<h3>{{ $job->name }}</h3>
<p class="text-body-secondary">{{ $job->description }}</p>
<br>
<p>Extensions</p>
<ul>
    @foreach($job->extensions->sortBy('name') as $extension)
    <li>{{ $extension->name }}</li>
    @endforeach
</ul>
@endsection