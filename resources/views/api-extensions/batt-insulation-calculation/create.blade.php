<h5 class="mb-3">Batt Insulation Calculation</h5>
<div class="row" id="{{ $class::concatPrefix('battInsulationCalculationContainer') }}">
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $class::concatPrefix('selectMethod') }}" class="form-label">Method</label>
            <select class="form-select" id='{{ $class::concatPrefix('selectMethod') }}' name="{{ $class::concatPrefix('method') }}">
                <option disabled selected label="Choose method..."></option>

                @foreach($class::getAllMethods() as $method)                   
                <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $class::concatPrefix('selectRValue') }}" class="form-label">R-Value</label>
            <select class="form-select" id="{{ $class::concatPrefix('selectRValue') }}" name="{{ $class::concatPrefix('rvalue') }}">
                <option disabled selected label="Waiting method..."></option>
            </select>
            @foreach($class::getAllMethodsWithRValues() as $method => $rvalues)                   
            <template id='{{ $class::concatPrefix( "{$method}RValuesOptionsTemplate" ) }}'>
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
    <label for="{{ $class::concatPrefix('inputSquareFeets') }}" class="form-label">Square feets</label>
    <input type="number" class="form-control" min='0' step="0.01" id="{{ $class::concatPrefix('inputSquareFeets') }}" name="{{ $class::concatPrefix('square_feets') }}" value="0">
</div>
<div class="mb-3">
    <label for="{{ $class::concatPrefix('inputFacing') }}" class="form-label">Facing</label>
    <select class="form-select" id="{{ $class::concatPrefix('inputFacing') }}" name="{{ $class::concatPrefix('facing') }}">
        @foreach($class::getAllFacing() as $facing)
        <option value="{{ $facing }}">{{ ucfirst($facing) }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="{{ $class::concatPrefix('inputSize') }}" class="form-label">Size</label>
    <select class="form-select" id="{{ $class::concatPrefix('inputSize') }}" name="{{ $class::concatPrefix('size') }}">
        @foreach($class::getAllSizes() as $size)
        <option value="{{ $size }}">{{ ucfirst($size) }}</option>
        @endforeach
    </select>
</div>
