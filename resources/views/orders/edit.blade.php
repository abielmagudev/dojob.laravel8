@extends('application')
@section('content')
<x-card>
    <form action="{{ route('orders.update', $order) }}" method="post">
        @include('orders._form')
        @method('patch')
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>

@if( $order->job->hasExtensions() )
@include('orders._script-loader-job-extensions')
<script>jobExtensions.load("<?= route('orders-job-extensions.edit', $order) ?>")</script>
@endif

@endsection
