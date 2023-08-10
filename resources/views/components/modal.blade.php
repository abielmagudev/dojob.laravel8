<?php $settings = (object) [
    'id' => $id,
    'title' => $title ?? '',
    'footer_content' => isset($footerContent) ? $footerContent : false,
    'footer_close_class' => isset($footerCloseClass) ? $footerCloseClass : 'btn btn-secondary',
    'footer_close_text' => isset($footerCloseText) ? $footerCloseText : false,
    'header_close' => isset($headerClose),
]; ?>

<div class="modal fade" id="<?= $settings->id ?>" tabindex="-1" aria-labelledby="<?= $settings->id ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="<?= $settings->id ?>Label">{{ $settings->title }}</h1>
                @if( $settings->header_close )     
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>
            <div class="modal-body">
                {!! $slot !!}
            </div>
            <div class="modal-footer">
                @if( $settings->footer_content )
                {!! $settings->footer_content !!} 
                @endif

                @if( $settings->footer_close_text )
                <button type="button" class="<?= $settings->footer_close_class ?>" data-bs-dismiss="modal"><?= $settings->footer_close_text ?></button>
                @endif
            </div>
        </div>
    </div>
</div>

