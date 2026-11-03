@props(['icon', 'text'])
<div class="flex items-center bg-dark-100 p-2 rounded-lg border border-white/10 hover:scale-110 transition-all">
    <div class="flex items-center justify-center p-2 bg-rust rounded-lg">
        <iconify-icon icon="{{ $icon }}" width="30" height="30" class="text-white"
            title="{{ $text }}"></iconify-icon>
    </div>
    <strong class="ml-3">{{ $slot }}</strong>
</div>
