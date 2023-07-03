@extends('application')
@section('content')
<form action="{{ route('jobs.update', $job) }}" method="post">
    @method('put')
    @include('jobs._form')
    <br>
    <button type="submit" class="btn btn-warning">Update job</button>
    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Back</a>
</form>
@endsection
