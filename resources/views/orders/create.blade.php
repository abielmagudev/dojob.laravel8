@extends('application')
@section('content')
<form action="{{ route('orders.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="inputScheduleDate" class="form-label">Schedule</label>
        <input type="date" class="form-control mb-3" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date') }}">
        <input type="time" class="form-control" id="inputScheduleTime" name="scheduled_time" value="{{ old('scheduled_time') }}">
    </div>

    <div class="mb-3">
        <label for="selectJob" class="form-label">Job</label>
        <select class="form-select" name="job" id='selectJob'>
            <option disabled selected label="Choose a job"></option>
            @foreach($jobs as $job)
            <option value="{{ $job->id }}" data-has-extensions="{{ $job->extensions_count }}">{{ $job->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="text-center d-none" id="extensionsLoadingSpinner">       
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="bg-light border rounded p-3 mb-3 d-none" id='extensionsContainer'></div>
    
    <br>
    <button class="btn btn-success" type="submit">Save order</button>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
</form>
@include('orders._script-extension-loader')
{{-- @include('orders._all_scripts_extensions') --}}
@endsection
