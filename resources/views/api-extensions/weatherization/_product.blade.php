<div class="row">
    <div class="col-sm">
        <div class="mb-3">
            <select class="form-select bg-light" name="{{ $controls->products['name'] }}[]" readonly>
                @isset($values)
                <option value="{{ $values['product'] }}">{{ $values['product'] }}</option>
                @endisset
            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="mb-3">
            <input type="number" class="form-control bg-light" min='1' step="1" name="{{ $controls->quantities['name'] }}[]" value="{{ isset($values) ? $values['quantity'] : null }}" readonly>
        </div>
    </div>
    <div class="col-sm col-sm-2">
        <div class="text-end mb-3">
            <button class="btn btn-outline-danger w-100" type="button">
                {{-- <i class="fst-normal">-</i> --}}
                Remove
            </button>
        </div>       
    </div>
</div>
