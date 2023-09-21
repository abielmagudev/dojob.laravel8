<h5 class="mb-3">Preventive Maintenance</h5>
<div id="{{ $class::prefix('nextSchedulesContainer') }}">
    <div class="mb-3 {{ $class::prefix('nextScheduleWrapper') }}">
        <div class="float-end me-3">
            <a href="#!" class="link-danger fw-bold text-decoration-none {{ $class::prefix('removeNextScheduleButton') }}">X</a>
        </div>
        <label for="{{ $class::prefix('nextScheduleInput1') }}" class="form-label">1. Next schedule</label>
        <input id="{{ $class::prefix('nextScheduleInput1') }}" type="date" class="form-control" name="{{ $class::prefix('next_schedule[]') }}">
    </div>
</div>
<template id="{{ $class::prefix('nextScheduleTemplate') }}">
    <div class="mb-3 {{ $class::prefix('nextScheduleWrapper') }}">
        <div class="float-end me-3">
            <a href="#!" class="link-danger fw-bold text-decoration-none {{ $class::prefix('removeNextScheduleButton') }}">X</a>
        </div>
        <label for="{{ $class::prefix('nextScheduleInput') }}" class="form-label">Next schedule</label>
        <input id="{{ $class::prefix('nextScheduleInput') }}" type="date" class="form-control" name="{{ $class::prefix('next_schedule[]') }}">
    </div>
</template>
<div class="text-end">
    <button id="{{ $class::prefix('addNextScheduleButton') }}" class="btn btn-outline-primary" type="button">Add next schedule</button>
</div>

<script src="{{ asset('assets/xjs/pm.js') }}" class="fake"></script>
