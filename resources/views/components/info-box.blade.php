<div class="info-box{{ isset($bg_color) ? ' '.$bg_color : ''  }}">
    <span class="info-box-icon {{ $icon_bg_color ?? 'bg-gradient-gray' }}"><i class="far fa-chart-bar"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">{{ $title }}</span>
        <span class="info-box-number">{{ $slot }}</span>
    </div>
</div>
