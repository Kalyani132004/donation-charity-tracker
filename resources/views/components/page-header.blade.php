<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
    <div>
        <h4 class="mb-1">{{ $title }}</h4>
        @isset($subtitle)
            <p class="text-muted mb-0">{{ $subtitle }}</p>
        @endisset
    </div>
    @isset($action)
        <div>{{ $action }}</div>
    @endisset
</div>
