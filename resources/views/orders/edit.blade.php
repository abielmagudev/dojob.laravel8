@extends('application')
@section('content')
<div class="card border-0 shadow">
    <div class="card-body">
        <form action="{{ route('orders.update', $order) }}" method="post">
            @include('orders._form')
            @method('patch')
            <div class="text-end">
                <button class="btn btn-warning" type="submit">Update order</button>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
            </div>
        </form>
    </div>
</div>

@if( $order->job->hasExtensions() )
@include('orders._script-loader-job-extensions')
<script>jobExtensions.load("<?= route('orders-job-extensions.edit', $order) ?>")</script>
@endif

@endsection
