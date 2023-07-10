<h5 class="mb-3">Preventive Maintenance</h5>
<div id="{{ $class::getWithPrefix('nextSchedulesContainer') }}">
    <div class="mb-3 {{ $class::getWithPrefix('nextScheduleWrapper') }}">
        <div class="float-end me-3">
            <a href="#!" class="link-danger fw-bold text-decoration-none {{ $class::getWithPrefix('removeNextScheduleButton') }}">X</a>
        </div>
        <label for="{{ $class::getWithPrefix('nextScheduleInput1') }}" class="form-label">1. Next schedule</label>
        <input id="{{ $class::getWithPrefix('nextScheduleInput1') }}" type="date" class="form-control" name="{{ $class::getWithPrefix('next_schedule[]') }}">
    </div>
</div>
<template id="{{ $class::getWithPrefix('nextScheduleTemplate') }}">
    <div class="mb-3 {{ $class::getWithPrefix('nextScheduleWrapper') }}">
        <div class="float-end me-3">
            <a href="#!" class="link-danger fw-bold text-decoration-none {{ $class::getWithPrefix('removeNextScheduleButton') }}">X</a>
        </div>
        <label for="{{ $class::getWithPrefix('nextScheduleInput') }}" class="form-label">Next schedule</label>
        <input id="{{ $class::getWithPrefix('nextScheduleInput') }}" type="date" class="form-control" name="{{ $class::getWithPrefix('next_schedule[]') }}">
    </div>
</template>
<div class="text-end">
    <button id="{{ $class::getWithPrefix('addNextScheduleButton') }}" class="btn btn-primary" type="button">Add next schedule</button>
</div>

