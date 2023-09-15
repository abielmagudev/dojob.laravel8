@extends('application')
@section('content')
@include('extensions.index.search')
<x-card>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Tags</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($apiExtensions as $apiExtension)             
                    <tr>
                        <td>
                            <p class='mb-0'>{{ $apiExtension->name }}</p>
                            <small class='text-muted'>{{ $apiExtension->description }}</small>
                        </td>
                        <td>
                        @foreach($apiExtension->tags_array as $tag)
                            <a href="{{ route('extensions.index', ['tags' => $tag]) }}" class="badge rounded-pill text-bg-dark">{{ $tag }}</a>
                        @endforeach
                        </td>
                        <td class='text-end'>
                            @if( $extensions->contains('api_extension_id', '=', $apiExtension->id) )
                            <form action="{{ route('extensions.destroy', $apiExtension->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger w-100" type="submit">Uninstall</button>
                            </form>
                            
                            @else
                            <button class="btn btn-outline-success w-100" type="submit" form="formInstallExtension" name="extension" value="{{ $apiExtension->id }}">Install</button>
    
                            @endif
                        </td>
    
                        
                        <?php /*
                        <td>${{ $apiExtension->price }}</td>
                        <td class="text-end">
                            @if( $extensions->contains('apiExtension_id', '=', $apiExtension->id) )
                            <span class="btn btn-outline-secondary btn-sm disabled w-100">Got it</span>
    
                            @elseif( $apiExtension->price <= 0 )
                            <button class="btn btn-outline-success btn-sm w-100">It's free!</button>
                            
                            @elseif( $apiExtension->free_try )
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
</x-card>
@endsection
