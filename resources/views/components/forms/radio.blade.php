@props(['name', 'value', 'label', 'checked' => false])

<div class="flex items-center mb-2">
    <input
        type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        id="{{ $name }}-{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300']) }}
    >
    <label for="{{ $name }}-{{ $value }}" class="ml-2 block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
</div>
