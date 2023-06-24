@props(['disabled' => false])

<div {!! $attributes->merge(['class' => 'p-0 h-8 bg-cgray border-none rounded-none shadow-none']) !!}>
    <input class="bg-transparent m-0 w-full h-full focus:border-indigo-500 focus:ring-indigo-500" {{ $disabled ? 'disabled' : '' }}>
</div>
