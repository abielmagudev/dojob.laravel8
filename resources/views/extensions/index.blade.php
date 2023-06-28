@extends('application')
@section('content')
<div class="text-end">
    <form action="{{ route('extensions.index') }}" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tags like maintenance, insulation, carpenter..." name="tags" value="{{ $tags }}">
            <button class="btn btn-primary" type="submit">Filter</button>
          </div>
    </form>
</div>
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Tags</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($api_extensions as $api_extension)             
                <tr>

                    <td>{{ $api_extension->model_class::getName() }}</td>
                    <td>{{ $api_extension->model_class::getDescription() }}</td>
                    <td>
                    @foreach($api_extension->tags_array as $tag)
                        <span class="badge rounded-pill text-bg-dark">{{ $tag }}</span>
                    @endforeach
                    </td>
                    <td class='text-end'>
                        @if( $extensions->contains('api_extension_id', '=', $api_extension->id) )
                        <span class="btn btn-secondary w-100 disabled">Installed</span>
                        
                        @else
                        <button class="btn btn-outline-success w-100" type="submit" form="formInstallExtension" name="extension" value="{{ $api_extension->id }}">Install</button>

                        @endif
                    </td>

                    <?php /*
                    <td>${{ $api_extension->price }}</td>
                    <td class="text-end">
                        @if( $extensions->contains('api_extension_id', '=', $api_extension->id) )
                        <span class="btn btn-outline-secondary btn-sm disabled w-100">Got it</span>

                        @elseif( $api_extension->price <= 0 )
                        <button class="btn btn-outline-success btn-sm w-100">It's free!</button>
                        
                        @elseif( $api_extension->free_try )
                        <button class="btn btn-outline-success btn-sm w-100">Free try</button>

                        @else
                        <button type="button" class="btn btn-outline-success btn-sm w-100">Purchase</button>

                        @endif

                    </td>
                    */ ?>
                </tr>
                @endforeach
            </tbody>
    </table>
</div>
<form action="{{ route('extensions.store') }}" method="post" id='formInstallExtension'>
    @csrf
</form>
@endsection
