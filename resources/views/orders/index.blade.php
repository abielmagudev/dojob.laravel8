@extends('application')
@section('content')
<p class="text-end">
    <a href="{{ route('orders.create') }}" class="btn btn-primary">New order</a>
</p>
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Job</th>
                <th colspan="2">Scheduled</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)           
            <tr>
                <td>{{ $order->job->name }}</td>
                <td style="width:160px">{{ $order->scheduled_date_human }}</td>
                <td style="width:160px">{{ $order->scheduled_time_human }}</td>
                <td class="text-end">
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm">Show</a>
                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
