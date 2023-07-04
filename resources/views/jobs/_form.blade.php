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
    <input type="number" step="1" min="0" class="form-control" id="inputSuccessfulInspections" name="successful_inspections_counter" value="{{ old('successful_inspections_required', ($job->successful_inspections_required ?? 0)) }}">
</div>
@if( is_int($job->id) )
<p>Extensions</p>
<div class="table-responsive border mb-3" style="height:256px">
    <table class="table">
        <tbody>
            @foreach($extensions as $extension)
            <?php $element_id = "extension{$extension->id }" ?>
            <tr>
                <td style="width:1%">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="{{ $element_id }}" name="extensions[]" value="{{ $extension->id }}" {{ isChecked( $job->extensions->contains('id', $extension->id) ) }}>
                    </div>
                </td>
                <td>
                    <label class="form-check-label d-block" for="{{ $element_id }}">
                        {{ $extension->info->name }}
                        <small class="d-block text-muted">{{ $extension->info->description }}</small>
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
