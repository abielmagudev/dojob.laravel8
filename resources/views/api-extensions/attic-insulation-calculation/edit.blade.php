<?php
$controls = (object) [
    'method' => (object) [
        'id' => $class::concatPrefix('selectMethod'),
        'name' => $class::concatPrefix('method'),
    ],
    'rvalue' => (object) [
        'id' => $class::concatPrefix('selectRValue'),
        'name' => $class::concatPrefix('rvalue'),
    ],
    'squarefeets'=> (object) [
        'id' => $class::concatPrefix('inputSquareFeets'),
        'name' => $class::concatPrefix('square_feets'),
    ],
    'bags' => (object) [
        'id' => $class::concatPrefix('divBags'),
    ],
];
?>
<h5 class="mb-3">Attic Insulation Calculation</h5>
<div class="row" id="{{ $class::concatPrefix('atticInsulationCalculationWrapper') }}">
    {{-- Methods --}}
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $controls->method->id }}" class="form-label">Method</label>
            <select class="form-select {{ bsInputInvalid( $errors->has($controls->method->name) ) }}" id='{{ $controls->method->id }}' name="{{ $controls->method->name }}">
                <option disabled selected label="Choose method..."></option>

                @foreach($class::getAllMethods() as $method)                   
                <option value="{{ $method }}" {{ isSelected( old($controls->method->name, $data->method) == $method ) }}>{{ ucfirst($method) }}</option>
                @endforeach

            </select>
            <x-error name='{{ $controls->method->name }}'></x-error>
        </div>
    </div>

    {{-- RValues --}}
    <div class="col-sm">
        <div class="mb-3">
            <label for="{{ $controls->rvalue->id }}" class="form-label">R-Value</label>
            <select class="form-select {{ bsInputInvalid( $errors->has($controls->rvalue->name) ) }}" id="{{ $controls->rvalue->id }}" name="{{ $controls->rvalue->name }}">
                @if(! old( $controls->method->name, $data->method ) )          
                <option disabled selected label="Waiting method..."></option>

                @else
                <option disabled selected label="Choose a R-Value of <?= ucfirst( old($controls->method->name) ) ?>..."></option>

                <?php $rvalues = $class::getAllMethodsWithRValues()[ old($controls->method->name, $data->method) ] ?? [] ?>
                @foreach($rvalues as $rvalue_name => $rvalue_amount)
                <option data-amount="{{ $rvalue_name == $data->rvalue_name ? $data->rvalue_amount : $rvalue_amount }}" value="{{ $rvalue_name }}" {{ isSelected( old($controls->rvalue->name, $data->rvalue_name) == $rvalue_name ) }}>{{ $rvalue_name }}</option>
                @endforeach

                @endif
            </select>
            <x-error name='{{ $controls->rvalue->name }}'></x-error>

            @foreach($class::getAllMethodsWithRValues() as $method => $rvalues)                   
            <template id='{{ $class::concatPrefix( "{$method}RValuesOptionsTemplate" ) }}'>
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
            <input type="number" class="form-control {{ bsInputInvalid( $errors->has($controls->squarefeets->name) ) }}" min='0' step="0.01" id="{{ $controls->squarefeets->id }}" name="{{ $controls->squarefeets->name }}" value="{{ old($controls->squarefeets->name, $data->square_feets) }}">
            <x-error name='{{ $controls->squarefeets->name }}'></x-error>
        </div>
    </div>

    {{-- Bags --}}
    <div class="col-sm">
        <div class="mb-3">
            <label class="form-label">Bags</label>
            <div class="form-control fw-bold text-center" id='{{ $controls->bags->id }}'>
                {{
                    $class::calculateBags( 
                        old($controls->method->name, $data->method), 
                        old($controls->rvalue->name, $data->rvalue_name), 
                        old($controls->squarefeets->name, $data->square_feets) ?? 0
                    );
                }}
            </div>
        </div>
    </div>
</div>
