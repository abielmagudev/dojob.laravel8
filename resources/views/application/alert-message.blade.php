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

@foreach($colors as $message_color)
    @if( session()->has($message_color) )
    <x-alert color="{{ $message_color }}" close>
        {{ session()->get($message_color) }}
    </x-alert>
    @endif
@endforeach
