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
    @if(! isset($order) )
    <select class="form-select {{ bsInputInvalid( $errors->has('job') ) }}" name="job" id='selectJob'>
        <option disabled selected label="Choose a job"></option>
        @foreach($jobs as $job)
        <option value="{{ $job->id }}" data-has-extensions="{{ $job->extensions_count }}" {{ isSelected( old('job') == $job->id ) }}>{{ $job->name }}</option>
        @endforeach
    </select>
    <x-error name="job"></x-error>
        
    @else
        <div class="form-control bg-light">{{ $order->job->name }}</div>
        
        @if( $order->job->hasExtensions() )
        <input class="d-none" type="hidden" id='selectJob' name="job" value="{{ $order->job_id }}" data-has-extensions="1">     
        @endif

    @endif
</div>

<div id="jobExtensionsWrapper">
    <div id="loadingMessage" class="text-center d-none">       
        <div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span>Checking if job has extensions...</span>
    </div>
    <div id='jobExtensionsContainer' class="alert alert-light d-none" ></div>
</div>
<br>
