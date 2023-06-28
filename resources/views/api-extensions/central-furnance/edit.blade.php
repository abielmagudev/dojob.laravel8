<h5 class="mb-3">Central Furnance Extension</h5>
<div class="mb-3">
    <label for="inputSerial" class="form-label">Serial</label>
    <input type="text" class="form-control" id="inputSerial" name="serial" value="">
</div>
<div class="mb-3">
    <label for="inputModel" class="form-label">Model</label>
    <input type="text" class="form-control" id="inputSquareFeets" name="model" value="">
</div>
<div class="mb-3">
    <label for="selectSize" class="form-label">Size</label>
    <select class="form-select" id="selectSize" name="size">
        @foreach(range(1, 5, 1) as $size)
        <option value="{{ $size }}">{{ $size }} tons</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="selectType" class="form-label">Type</label>
    <select class="form-select" id="selectType" name="type">
        @foreach(['electric', 'gas'] as $type)
        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="selectPlatform" class="form-label">Platform</label>
    <select class="form-select" id="selectPlatform" name="selectPlatform">
        @foreach(['No, without platform', 'Yes, with platform'] as $key => $text)
        <option value="{{ $key }}">{{ $text }}</option>
        @endforeach
    </select>
</div>
