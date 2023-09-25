@if( $products_count = count( $old['products'] ) )  

    @for($i = 0; $i < $products_count; $i++)

    @include('api-extensions.weatherization._product', [
        'controls' => $controls,  
        'values' => [
            'product' => $old['products'][$i],
            'quantity' => $old['quantities'][$i],
        ],
    ])

    @endfor

@endif
