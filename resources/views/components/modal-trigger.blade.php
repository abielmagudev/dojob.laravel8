<?php $settings = (object) [
    'modal_id' => $modalId,
    'class' => isset($class) ? $class : '',
    'color' => isset($color) ? $color : 'primary',
    'id' => isset($id) ? $id : "trigger{$modalId}",
    'is_link' => isset($isLink),
]; ?>

@if( $settings->is_link )
<a href="#!" class="link-<?= $settings->color ?> <?= $settings->class ?>" data-bs-toggle="modal" data-bs-target="#<?= $settings->modal_id ?>">
    {{ $slot }}
</a>

@else
<button type="button" class="btn btn-<?= $settings->color ?> <?= $settings->class ?>" data-bs-toggle="modal" data-bs-target="#<?= $settings->modal_id ?>">
    {{ $slot }}
</button>

@endif
