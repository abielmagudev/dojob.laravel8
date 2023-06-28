@extends('application')
@section('content')
<p class="text-end">
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
</p>

<small>Job</small>
<p>{{ $order->job->name }}</p>

<small>Scheduled</small>
<p>{{ $order->full_scheduled_human }}</p>

<small>Timeline</small>
<p>Created, Started, finished, closed, updated...</p>

<small>Media</small>
<p>All files and photos</p>
@endsection
