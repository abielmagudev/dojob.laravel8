<h5 class="mb-3">Attic Insulation Calculation</h5>
<div class="row">
    <div class="col-sm">
        <div class="mb-3">
            <?php $prefix_id = $atticInsulationCalculation::getPrefixInputId('selectMethod') ?>

            <label for="{{ $prefix_id }}" class="form-label">Method</label>
            <select class="form-select" id='{{ $prefix_id }}' name="{{ $atticInsulationCalculation::getPrefixInputName('method') }}">
                <option disabled selected label="Choose method..."></option>
                @foreach($atticInsulationCalculation::getAllMethods() as $method)                   
                <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <?php $prefix_id = $atticInsulationCalculation::getPrefixInputId('selectRValue') ?>

            <label for="{{ $prefix_id }}" class="form-label">R-Value</label>
            <select class="form-select" id="{{ $prefix_id }}" name="{{ $atticInsulationCalculation::getPrefixInputName('rvalue') }}">
                <option disabled selected label="Choose R-Value..."></option>
                @foreach($atticInsulationCalculation::getAllMethodsWithRValues() as $method => $rvalues)                   
                <optgroup label="{{ ucfirst($method) }}" class="d-none">
                    @foreach($rvalues as $rvalue_name => $rvalue_amount)
                    <option data-amount="{{ $rvalue_amount }}" value="{{ $rvalue_name }}">{{ $rvalue_name }}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <?php $prefix_id = $atticInsulationCalculation::getPrefixInputId('inputSquareFeets') ?>

            <label for="{{ $prefix_id }}" class="form-label">Square feets</label>
            <input type="number" class="form-control" min='0' step="0.01" id="{{ $prefix_id }}" name="{{ $atticInsulationCalculation::getPrefixInputName('square_feets') }}">
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <?php $prefix_id = $atticInsulationCalculation::getPrefixInputId('divTotalBags') ?>

            <label for="{{ $prefix_id }}" class="form-label">Total bags</label>
            <div class="form-control fw-bold text-center" id='{{ $prefix_id }}'>0</div>
        </div>
    </div>
</div>
