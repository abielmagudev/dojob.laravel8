@csrf
<div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" id="inputName" name="name" value="{{ $job->name }}">
</div>
<div class="mb-3">
    <label for="textareaDescription" class="form-label">Description</label>
    <textarea id="textareaDescription" rows="3" class="form-control" name="description">{{ $job->description }}</textarea>
</div>
