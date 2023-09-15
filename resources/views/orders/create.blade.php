@extends('application')
@section('content')
<x-card>
    <form action="{{ route('orders.store') }}" method="post">
        @include('orders._form')
        <br>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Save order</button>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
        </div>
    </form>
</x-card>

@push('scripts') 
    @include('orders._script-loader-job-extensions')
    @include('orders._script-select-job-extensions')

    @if( old('job') )
    <script>
        selectJob.shootChangeEvent()
    </script>
    @endif
@endpush

@endsection
