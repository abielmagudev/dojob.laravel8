@extends('application')
@section('content')
<div class="card border-0 shadow">
    <div class="card-body">
        <form action="{{ route('orders.store') }}" method="post">
            @include('orders._form')
            <div class="text-end">
                <button class="btn btn-success" type="submit">Save order</button>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@include('orders._script-loader-job-extensions')
@include('orders._script-select-job-extensions')

@if( old('job') )
<script>selectJob.shootChangeEvent()</script>
@endif

@endsection
