<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}-label" aria-hidden="true">
    <div class="modal-dialog modal-{{ $size ?? 'lg' }} modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content saas-modal" style="border: none; border-radius: var(--ds-radius-2xl); box-shadow: var(--ds-shadow-2xl);">
            <div class="saas-modal-header">
                <h5 class="modal-title" id="{{ $id }}-label" style="font-size:17px;font-weight:700;">{{ $title }}</h5>
                <button type="button" class="modal-close" data-bs-dismiss="modal" style="border:none;background:transparent;font-size:20px;cursor:pointer;color:var(--ds-text-tertiary);width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;">✕</button>
            </div>
            <div class="saas-modal-body">
                {{ $slot }}
            </div>
            @isset($footer)
            <div class="saas-modal-footer">
                {{ $footer }}
            </div>
            @endisset
        </div>
    </div>
</div>
