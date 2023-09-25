<?php $controls = (object) [
    'product' => [
        'id' => $class::prefix('selectProduct'),
        'name' => $class::prefix('product'),
    ],
    'quantity' => [
        'id' => $class::prefix('inputQuantity'),
        'name' => $class::prefix('quantity'),
    ],
    'products' => [
        'name' => $class::prefix('products'),
    ],
    'quantities' => [
        'name' => $class::prefix('quantities'),
    ],
] ?>
<h5 class="mb-3">Weatherization</h5>
<div id="weatherizationExtension">
    <div class="row" id="productSetup">
        <div class="col-sm">
            <div class="">
                <label for="{{ $controls->product['id'] }}" class="form-label">Product</label>
                <select class="form-select" id='{{ $controls->product['id'] }}'>
                    <option disabled selected label="Choose..."></option>
                    @foreach(['one', 'two', 'three'] as $item)
                    <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                    @endforeach
                </select>
            </div>
            <x-error :name="$controls->products['name']" />
        </div>
        <div class="col-sm">
            <div class="">
                <label for="{{ $controls->quantity['id'] }}" class="form-label">Quantity</label>
                <input type="number" class="form-control" min='1' step="1" id="{{ $controls->quantity['id'] }}">
            </div>
            <x-error :name="$controls->quantities['name']" />
        </div>
        <div class="col-sm col-sm-2">
            <div class="text-end mb-3">
                <label class="form-label">&nbsp;</label>
                <button class="btn btn-primary w-100" type="button">
                    {{-- <i class="fst-normal">+</i> --}}
                    Add
                </button>
            </div>       
        </div>
    </div>

    <div id="addedProducts">
        @include('api-extensions.weatherization._add_order_products', [
            'controls' => $controls,
            'collection' => $collection
        ])

        @include('api-extensions.weatherization._add_old_products', [
            'controls' => $controls,
            'old' => [
                'products' => old($controls->products['name'], []),
                'quantities' => old($controls->quantities['name'], []),
            ]
        ])
    </div>
    
    <template id="productTemplate">
        @include('api-extensions.weatherization._product', [
            'controls' => $controls,
        ])
    </template>
</div>

<script src="{{ asset('assets/xjs/wz.js') }}" class='fake'></script>
