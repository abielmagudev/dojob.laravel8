<?php
$controls = (object) [
    'method' => [
        'id' => $class::prefix('selectMethod'),
        'name' => $class::prefix('method'),
    ],
    'rvalue' => [
        'id' => $class::prefix('selectRValue'),
        'name' => $class::prefix('rvalue'),
    ],
    'square_feets' => [
        'id' => $class::prefix('inputSquareFeets'),
        'name' => $class::prefix('square_feets'),
    ],
    'facing' => [
        'id' => $class::prefix('selectFacing'),
        'name' => $class::prefix('facing'),
    ],
    'size' => [
        'id' => $class::prefix('selectSize'),
        'name' => $class::prefix('size'),
    ],
];
?>
<h5 class="mb-3">Batt Insulation Calculation</h5>
<div class="row" id="{{ $class::prefix('battInsulationCalculationContainer') }}">
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $controls->method['id'] }}" class="form-label">Method</label>
            <select class="form-select" id='{{ $controls->method['id'] }}' name="{{ $controls->method['name'] }}">
                <option disabled selected label="Choose method..."></option>

                @foreach($class::getAllMethods() as $method)                   
                <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $controls->rvalue['id'] }}" class="form-label">R-Value</label>
            <select class="form-select" id="{{ $controls->rvalue['id'] }}" name="{{ $controls->rvalue['name'] }}">
                <option disabled selected label="Waiting method..."></option>
            </select>
            @foreach($class::getAllMethodsWithRValues() as $method => $rvalues)                   
            <template id='{{ $class::prefix( "{$method}RValuesOptionsTemplate" ) }}'>
                <option disabled selected label="Choose a R-Value of <?= ucfirst($method) ?>..."></option>
                @foreach($rvalues as $rvalue_name)
                <option value="{{ $rvalue_name }}">{{ $rvalue_name }}</option>
                @endforeach
            </template>
            @endforeach
        </div>

    </div>
</div>
<div class="mb-3">
    <label for="{{ $controls->square_feets['id'] }}" class="form-label">Square feets</label>
    <input type="number" class="form-control" min='0' step="0.01" id="{{ $controls->square_feets['id'] }}" name="{{ $controls->square_feets['name'] }}" value="0">
</div>
<div class="mb-3">
    <label for="{{ $controls->facing['id'] }}" class="form-label">Facing</label>
    <select class="form-select" id="{{ $controls->facing['id'] }}" name="{{ $controls->square_feets['name'] }}">
        @foreach($class::getAllFacing() as $facing)
        <option value="{{ $facing }}">{{ ucfirst($facing) }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="{{ $controls->size['id'] }}" class="form-label">Size</label>
    <select class="form-select" id="{{ $controls->size['id'] }}" name="{{ $controls->size['name'] }}">
        @foreach($class::getAllSizes() as $size)
        <option value="{{ $size }}">{{ ucfirst($size) }}</option>
        @endforeach
    </select>
</div>

<script src="{{ asset('assets/xjs/bic.js') }}" class="fake"></script>
