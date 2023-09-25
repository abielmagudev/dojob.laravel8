@if( $collection->count() )
    
    @foreach($collection as $item)

    @include('api-extensions.weatherization._product', [
        'controls' => $controls,
        'values' => [
            'product' => $item->product,
            'quantity' => $item->quantity,
        ],
    ])
    
    @endforeach

@endif