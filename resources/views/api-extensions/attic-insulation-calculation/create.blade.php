<?php
$controls = (object) [
    'method' => (object) [
        'id' => $class::getWithPrefix('selectMethod'),
        'name' => $class::getWithPrefix('method'),
    ],
    'rvalue' => (object) [
        'id' => $class::getWithPrefix('selectRValue'),
        'name' => $class::getWithPrefix('rvalue'),
    ],
    'squarefeets'=> (object) [
        'id' => $class::getWithPrefix('inputSquareFeets'),
        'name' => $class::getWithPrefix('square_feets'),
    ],
    'bags' => (object) [
        'id' => $class::getWithPrefix('divBags'),
    ],
];
?>

<h5 class="mb-3">Attic Insulation Calculation</h5>
<div class="row" id="{{ $class::getWithPrefix('atticInsulationCalculationWrapper') }}">
    {{-- Methods --}}
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $controls->method->id }}" class="form-label">Method</label>
            <select class="form-select" id='{{ $controls->method->id }}' name="{{ $controls->method->name }}">
                <option disabled selected label="Choose method..."></option>

                @foreach($class::getAllMethods() as $method)                   
                <option value="{{ $method }}" {{ isSelected( old($controls->method->name) == $method ) }}>{{ ucfirst($method) }}</option>
                @endforeach

            </select>
        </div>
    </div>

    {{-- RValues --}}
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $controls->rvalue->id }}" class="form-label">R-Value</label>
            <select class="form-select" id="{{ $controls->rvalue->id }}" name="{{ $controls->rvalue->name }}">
                @if(! old( $controls->method->name ) )          
                <option disabled selected label="Waiting method..."></option>

                @else
                <option disabled selected label="Choose a R-Value of <?= ucfirst( old($controls->method->name) ) ?>..."></option>

                <?php $rvalues = $class::getAllMethodsWithRValues()[ old($controls->method->name) ] ?? [] ?>
                @foreach($rvalues as $rvalue_name => $rvalue_amount)
                <option data-amount="{{ $rvalue_amount }}" value="{{ $rvalue_name }}" {{ isSelected( old($controls->rvalue->name) == $rvalue_name ) }}>{{ $rvalue_name }}</option>
                @endforeach

                @endif
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

    {{-- Square feets --}}
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $controls->squarefeets->id }}" class="form-label">Square feets</label>
            <input type="number" class="form-control" min='0' step="0.01" id="{{ $controls->squarefeets->id }}" name="{{ $controls->squarefeets->name }}" value="{{ old($controls->squarefeets->name, 0) }}">
        </div>
    </div>

    {{-- Bags --}}
    <div class="col-sm">
        <div class="mb-3">
            <label class="form-label">Bags</label>
            <div class="form-control fw-bold text-center" id='{{ $controls->bags->id }}'>
                {{ 
                    $class::calculateBags( 
                        old($controls->method->name, 'no-method'), 
                        old($controls->rvalue->name, 'no-rvalue'), 
                        old($controls->squarefeets->name, 0)
                    )
                }}
            </div>
        </div>
    </div>
</div>
