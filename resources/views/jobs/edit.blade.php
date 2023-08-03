@extends('application')
@section('content')
<x-card>
    <form action="{{ route('jobs.update', $job) }}" method="post">
        @method('put')
        @include('jobs._form')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-warning">Update job</button>
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
@endsection
