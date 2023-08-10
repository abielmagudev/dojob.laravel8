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
<br>

<div>
    <div class="text-end">
        <x-modal-trigger modal-id="confirmDeleteOrderModal" color="danger" is-link>
            Delete order
        </x-modal-trigger>
    </div>
    <x-modal id="confirmDeleteOrderModal" title="Confirm to delete this order" footer-close-text="Cancel">
        <form action="{{ route('orders.destroy', $order) }}" method="post" id='formDeleteOrder'>
            @csrf
            @method('delete')
            <div class="text-center">
                <p class='lead'>Are you sure to delete the order <br> #<?= $order->id ?> - <?= $order->job->name ?> ?...</p>
                <p><b>All order data and its related extensions <br>will be permanently deleted.</b></p>
            </div>
        </form>
        <x-slot name="footerContent">
            <button class="btn btn-outline-danger" type="submit" form="formDeleteOrder">Yes, delete order</button>
        </x-slot>
    </x-modal>
</div>

@if( $order->job->hasExtensions() )
    @include('orders._script-loader-job-extensions')
    <script>jobExtensions.load("<?= route('orders-job-extensions.edit', $order) ?>")</script>
@endif

@endsection
