@props(['href'])

@php
    $normalizedHref = trim($href, '/');
    $isActive = request()->is($normalizedHref === '' ? '/' : $normalizedHref) || request()->is($normalizedHref . '/*');
@endphp

<a href="{{ $href }}" {{ $attributes->except('href')->class([
    'inline-flex items-center rounded-full px-4 py-2 text-sm font-medium transition-colors duration-200',
    'bg-teal-500 text-white shadow-sm hover:bg-teal-600' => $isActive,
    'text-slate-600 hover:bg-teal-50 hover:text-teal-700' => ! $isActive,
]) }}>
    {{ $slot }}
</a>
