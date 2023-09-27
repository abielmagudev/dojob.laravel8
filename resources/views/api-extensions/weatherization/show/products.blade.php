<x-card title="Products">
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->unit_price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
</x-card>