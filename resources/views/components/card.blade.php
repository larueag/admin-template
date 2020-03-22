<div class="card{{ isset($card_class) ? ' '.$card_class : '' }}">
    <div class="card-header{{ isset($header_class) ? ' '.$header_class : '' }}"{{ isset($collapsable) ? "data-card-widget=collapse" : '' }}>
        <h3 class="card-title{{ isset($title_class) ? ' '.$title_class : '' }}">
            @if(isset($icon))
                <i class="{{ $icon }}"></i>
            @endif
            {{ $title ?? '' }}
        </h3>
        @if(isset($actions))
            <div class="card-tools{{ isset($tools_class) ? ' '.$tools_class : '' }}">
                {{ $actions }}
            </div>
        @endif
    </div>
    <div class="card-body{{ isset($body_class) ? ' '.$body_class : '' }}">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif

    @if(isset($load_attribute))
        <div class="overlay">
            @if(isset($load_icon))
                <i class="{{ $load_icon }} fa-2x fa-spin"></i>
            @endif
        </div>
    @endif
</div>
