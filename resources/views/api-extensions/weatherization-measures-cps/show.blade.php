<h1>{{ $extension->name }}</h1>
<br>

<p class="text-end">
    <x-modal-trigger modal-id="modalAddProduct">Add product</x-modal-trigger>
</p>

<x-card title="Products">
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Item price ID</th>
                        <th>Material price</th>
                        <th>Labor price</th>
                        <th>Total cost</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->item_price_id }}</td>
                    <td>{{ $product->material_price }}</td>
                    <td>{{ $product->labor_price }}</td>
                    <td>{{ $product->total_cost }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-card>

<x-modal id="modalAddProduct" title="New product">
    <form action="{{ route('extensions.store') }}" method="post" autocomplete="off">
        <div class="mb-3">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputName" name="name">
        </div>
        <div class="mb-3">
            <label for="inputItemPriceId" class="form-label">Item price ID</label>
            <input type="number" class="form-control" id="inputItemPriceId" name="item_price_id" step="1" min="1">
        </div>
        <div class="mb-3">
            <label for="inputMaterialPrice" class="form-label">Material price</label>
            <input type="number" class="form-control" id="inputMaterialPrice" name="material_price" step="0.01" min="0.01">
        </div>
        <div class="mb-3">
            <label for="inputLaborPrice" class="form-label">Labor price</label>
            <input type="number" class="form-control" id="inputLaborPrice" name="labor_price" step="0.01" min="0.01">
        </div>
        <input type="hidden" name="extension" value="{{ $extension->id }}">
        @csrf
        <button class="btn btn-success" type="submit">Add product</button>
    </form>
</x-modal>