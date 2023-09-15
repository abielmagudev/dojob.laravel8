<?php $colors = [
    'danger',
    'dark',
    'info',
    'light',
    'primary',
    'secondary',
    'success',
    'warning',
] ?>

@foreach($colors as $status)
    @if( session()->has($status) )
    <x-alert color="{{ $status }}" close>
        {!! session()->get($status) !!}
    </x-alert>
    @endif
@endforeach
