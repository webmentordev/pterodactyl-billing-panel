@props(['image', 'text'])
<div class="flex items-center bg-dark-100 p-2 rounded-lg border border-white/10 hover:scale-110 transition-all">
    <div class="flex items-center justify-center p-2 bg-rust rounded-lg">
        <img src="{{ $image }}" alt="{{ $text }}" title="{{ $text }}" width="30">
    </div>
    <strong class="ml-3">{{ $slot }}</strong>
</div>
