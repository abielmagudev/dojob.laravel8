<h5 class="mb-3">Weatherization</h5>

@include('api-extensions.weatherization.show.products', [
    'products' => $products
])

<br>

@include('api-extensions.weatherization.show.categories', [
    'categories' => $categories
])
