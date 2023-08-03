<div class="alert alert-{{ $color }} alert-dismissible text-center" role="alert">
    <div>{!! $slot !!}</div>
    @if( isset($close) )
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
