@extends('application')
@section('content')
<form action="{{ route('jobs.store') }}" method="post">
    @include('jobs._form')
    <br>
    <button type="submit" class="btn btn-success">Save job</button>
    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Cancel</a>
</form>
@endsection