@extends('application')
@section('content')
<p class="text-end">
    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Back</a>
</p>
<x-card>
    <h4 class="card-title">{{ $job->name }}</h4>
    <p class="text-body-secondary">{{ $job->description }}</p>
    <br>
    <p>Extensions</p>
    <ul>
        @foreach($job->extensions->sortBy('name') as $extension)
        <li>{{ $extension->name }}</li>
        @endforeach
    </ul>
</x-card>
@endsection