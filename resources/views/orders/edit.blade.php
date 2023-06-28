@extends('application')
@section('content')
<form action="{{ route('orders.edit', $order) }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="inputScheduleDate" class="form-label">Schedule</label>
        <input type="date" class="form-control mb-3" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date', $order->scheduled_date) }}">
        <input type="time" class="form-control" id="inputScheduleTime" name="scheduled_time" value="{{ old('scheduled_time', $order->scheduled_time) }}">
    </div>
    <div class="mb-3">
        <label for="selectJob" class="form-label">Job</label>
        <div class="form-control">{{ $order->job->name }}</div>
    </div>
    @if( $order->job->hasExtensions() )       
    <label class="form-label">Extensions</label>
    <div id="extensionsContainer" class='bg-light py-3 px-4'>
        <div id="extensions"></div>
    </div>
    @endif
    <br>
    <button class="btn btn-warning" type="submit">Update order</button>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
</form>
<div id="templates"></div>
<script>

const extensions = document.getElementById('extensions');
const extension = fetch("<?= route('extensions.components', [$order->id, 'edit']) ?>")

extension
.then( res => res.json() )
.then( json => {
    let component = JSON.parse(json.components[0])
    console.log(component)
    extensions.innerHTML = component.template
})
</script>
@endsection
