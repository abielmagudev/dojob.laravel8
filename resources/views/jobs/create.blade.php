@extends('application')
@section('content')
<x-card>
    <form action="{{ route('jobs.store') }}" method="post">
        @include('jobs._form')
        <br>
        <div class="text-end">
            <button type="submit" class="btn btn-success">Save job</button>
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>
@endsection