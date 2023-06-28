@extends('application')
@section('content')
<form action="{{ route('jobs.update', $job) }}" method="post">
    @method('put')
    @include('jobs._form')
    <p>Extensions</p>
    <div class="table-responsive border" style="height:256px">
        <table class="table">
            <tbody>
                @foreach($extensions as $extension)
                <?php $element_id = "extension{$extension->id }" ?>
                <tr>
                    <td style="width:1%">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="{{ $element_id }}" name="extensions[]" value="{{ $extension->id }}" @checked( $job->extensions->find($extension->id) )>
                        </div>
                    </td>
                    <td>
                        <label class="form-check-label d-block" for="{{ $element_id }}">
                            {{ $extension->model_class::getName() }}
                            <small class="d-block text-muted">{{ $extension->model_class::getDescription() }}</small>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <button type="submit" class="btn btn-warning">Update job</button>
    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Back</a>
</form>
@endsection
