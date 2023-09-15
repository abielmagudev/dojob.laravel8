<div>
    <form action="{{ route('extensions.index') }}" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tags like maintenance, insulation, carpenter..." name="tags" value="{{ $tags }}" required>
            <button class="btn btn-primary" type="submit">Filter</button>
          </div>
    </form>
</div>
