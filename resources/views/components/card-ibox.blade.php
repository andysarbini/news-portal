<div class="ibox-title">
    @isset($title)
        {{ $title }}
    @endisset
</div>

@isset($content)    
    <div class="ibox-content">
        {{ $content }}
    </div>
@endisset