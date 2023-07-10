<h5 class="mb-3">Attic Insulation Calculation</h5>
<div class="row" id="{{ $class::getWithPrefix('atticInsulationCalculationContainer') }}">
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $class::getWithPrefix('selectMethod') }}" class="form-label">Method</label>
            <select class="form-select" id='{{ $class::getWithPrefix('selectMethod') }}' name="{{ $class::getWithPrefix('method') }}">
                <option disabled selected label="Choose method..."></option>

                @foreach($class::getAllMethods() as $method)                   
                <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $class::getWithPrefix('selectRValue') }}" class="form-label">R-Value</label>
            <select class="form-select" id="{{ $class::getWithPrefix('selectRValue') }}" name="{{ $class::getWithPrefix('rvalue') }}">
                <option disabled selected label="Waiting method..."></option>
            </select>
            @foreach($class::getAllMethodsWithRValues() as $method => $rvalues)                   
            <template id='{{ $class::getWithPrefix( "{$method}RValuesOptionsTemplate" ) }}'>
                <option disabled selected label="Choose a R-Value of <?= ucfirst($method) ?>..."></option>
                @foreach($rvalues as $rvalue_name => $rvalue_amount)
                <option data-amount="{{ $rvalue_amount }}" value="{{ $rvalue_name }}">{{ $rvalue_name }}</option>
                @endforeach
            </template>
            @endforeach
        </div>

    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $class::getWithPrefix('inputSquareFeets') }}" class="form-label">Square feets</label>
            <input type="number" class="form-control" min='0' step="0.01" id="{{ $class::getWithPrefix('inputSquareFeets') }}" name="{{ $class::getWithPrefix('square_feets') }}">
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <label class="form-label">Bags</label>
            <div class="form-control fw-bold text-center" id='{{ $class::getWithPrefix('divBags') }}'>0</div>
        </div>
    </div>
</div>
