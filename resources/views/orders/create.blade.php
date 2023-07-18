@extends('application')
@section('content')
<form action="{{ route('orders.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="inputScheduleDate" class="form-label">Schedule</label>
        <div class="mb-3">
            <input type="date" class="form-control {{ bsInputInvalid( $errors->has('scheduled_date') ) }}" id="inputScheduleDate" name="scheduled_date" value="{{ old('scheduled_date') }}">
            <x-error name="scheduled_date"></x-error>
        </div>
        <input type="time" class="form-control {{ bsInputInvalid( $errors->has('scheduled_time') ) }}" id="inputScheduleTime" name="scheduled_time" value="{{ old('scheduled_time') }}">
        <x-error name="scheduled_time"></x-error>
    </div>

    <div class="mb-3">
        <label for="selectJob" class="form-label">Job</label>
        <select class="form-select {{ bsInputInvalid( $errors->has('job') ) }}" name="job" id='selectJob'>
            <option disabled selected label="Choose a job"></option>
            @foreach($jobs as $job)
            <option value="{{ $job->id }}" data-has-extensions="{{ $job->extensions_count }}" {{ isSelected( old('job') == $job->id ) }}>{{ $job->name }}</option>
            @endforeach
        </select>
        <x-error name="job"></x-error>
    </div>

    <div id="jobExtensionsWrapper">
        <div id="loadingMessage" class="text-center d-none">       
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <span>Checking if job has extensions...</span>
        </div>
        <div id='extensionsContainer' class="alert alert-light d-none" ></div>
    </div>
    <br>

    <button class="btn btn-success" type="submit">Save order</button>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
</form>
@include('orders._script-extension-loader')
@includeWhen(old('job'), 'orders._script-extension-loader-trigger')

@endsection
