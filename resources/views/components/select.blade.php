@props(['disabled' => false])

<select
    {{ $attributes->merge(['class' => 'w-full outline-none border bg-dark border-white/10 text-white focus:border-rust focus:ring-rust rounded-md shadow-sm']) }}>
    {{ $slot }}
</select>