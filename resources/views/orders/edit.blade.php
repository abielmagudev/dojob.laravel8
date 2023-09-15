@extends('application')
@section('content')
<x-card>
    <form action="{{ route('orders.update', $order) }}" method="post">
        @include('orders._form')
        @method('patch')
        <br>
        <div class="text-end">
            <button class="btn btn-warning" type="submit">Update order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</x-card>
<br>

@if( $order->job->hasExtensions() )
@push('scripts') 
    @include('orders._script-loader-job-extensions')
    <script>
        jobExtensions.load("<?= route('orders-job-extensions.edit', $order) ?>")
    </script>
@endpush
@endif

<x-custom.modal-confirm-delete :route="route('orders.destroy', $order)" name="order">
    <p>¿Do you want to continue to delete the order <br> <b>#<?= $order->id ?> <?= $order->job->name ?></b>?</p>
</x-custom.modal-confirm-delete>

@endsection
