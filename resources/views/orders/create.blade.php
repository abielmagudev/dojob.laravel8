@extends('application')
@section('content')
<form action="{{ route('orders.store') }}" method="post">
    @include('orders._form')
    <button class="btn btn-success" type="submit">Save order</button>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
</form>

@include('orders._script-loader-job-extensions')
@include('orders._script-select-job-extensions')

@if( old('job') )
<script>selectJob.shootChangeEvent()</script>
@endif

@endsection
