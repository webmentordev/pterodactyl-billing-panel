@props(["text", "length" => 30])
<div x-data="{ expand: false }" class="cursor-pointer">
    <span x-show="!expand" @click="expand = true">{{ Str::limit($text, $length, '...') }}</span>
    <span x-show="expand" @click="expand = false">{{ $text }}</span>
</div>