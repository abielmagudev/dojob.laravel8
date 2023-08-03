<h5 class="mb-3">Preventive Maintenance</h5>
<div id="{{ $class::concatPrefix('nextSchedulesContainer') }}">
    <div class="mb-3 {{ $class::concatPrefix('nextScheduleWrapper') }}">
        <div class="float-end me-3">
            <a href="#!" class="link-danger fw-bold text-decoration-none {{ $class::concatPrefix('removeNextScheduleButton') }}">X</a>
        </div>
        <label for="{{ $class::concatPrefix('nextScheduleInput1') }}" class="form-label">1. Next schedule</label>
        <input id="{{ $class::concatPrefix('nextScheduleInput1') }}" type="date" class="form-control" name="{{ $class::concatPrefix('next_schedule[]') }}">
    </div>
</div>
<template id="{{ $class::concatPrefix('nextScheduleTemplate') }}">
    <div class="mb-3 {{ $class::concatPrefix('nextScheduleWrapper') }}">
        <div class="float-end me-3">
            <a href="#!" class="link-danger fw-bold text-decoration-none {{ $class::concatPrefix('removeNextScheduleButton') }}">X</a>
        </div>
        <label for="{{ $class::concatPrefix('nextScheduleInput') }}" class="form-label">Next schedule</label>
        <input id="{{ $class::concatPrefix('nextScheduleInput') }}" type="date" class="form-control" name="{{ $class::concatPrefix('next_schedule[]') }}">
    </div>
</template>
<div class="text-end">
    <button id="{{ $class::concatPrefix('addNextScheduleButton') }}" class="btn btn-outline-primary" type="button">Add next schedule</button>
</div>

