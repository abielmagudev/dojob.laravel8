@csrf
<div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" id="inputName" name="name" value="{{ $job->name }}">
</div>
<div class="mb-3">
    <label for="textareaDescription" class="form-label">Description</label>
    <textarea id="textareaDescription" rows="3" class="form-control" name="description">{{ $job->description }}</textarea>
</div>
<div class="mb-3">
    <label for="inputSuccessfulInspections" class="form-label">Successful inspections required</label>
    <input type="number" step="1" min="0" class="form-control" id="inputSuccessfulInspections" name="successful_inspections_required" value="{{ old('successful_inspections_required', ($job->successful_inspections_required ?? 0)) }}">
</div>
@if( $job->isReal() )
<label class="form-label">Extensions</label>
<div class="table-responsive border mb-3" style="height:256px">
    <table class="table">
        <tbody>
            @foreach($extensions as $extension)
            <?php $element_id = "extension{$extension->initials_name }" ?>
            <tr>
                <td style="width:1%">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="{{ $element_id }}" name="extensions[]" value="{{ $extension->api_id }}" {{ isChecked( $job->extensions->contains('api_id', $extension->api_id) ) }}>
                    </div>
                </td>
                <td>
                    <label class="form-check-label d-block" for="{{ $element_id }}">
                        {{ $extension->name }}
                        <small class="d-block text-muted">{{ $extension->description }}</small>
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
