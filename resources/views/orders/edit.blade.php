@extends('application')
@section('content')
<form action="{{ route('orders.update', $order) }}" method="post">
    @include('orders._form')
    @method('patch')

    <button class="btn btn-warning" type="submit">Update order</button>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
</form>

@include('orders._script-job-extensions', ['method' => 'edit', 'order' => $order->id])

@include('orders._script-job-extensions-trigger')

@endsection
