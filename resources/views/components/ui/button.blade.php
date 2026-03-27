@props(['variant' => 'default', 'href' => null])

@php
$styles = [
    'default'  => 'bg-white text-black hover:bg-gray-200',
    'dark'  => 'bg-slate-700 text-white hover:bg-slate-600',
    'danger'   => 'bg-red-500 text-white hover:bg-red-600',
    'ghost'    => 'bg-transparent text-gray-700 hover:bg-gray-200',
];
$classes = "m-2 px-4 py-2 rounded-md font-medium border-1 cursor-pointer {$styles[$variant]}";
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }}">{{ $slot }}</a>
@else
    <button type="submit" class="{{ $classes }}">{{ $slot }}</button>
@endif
