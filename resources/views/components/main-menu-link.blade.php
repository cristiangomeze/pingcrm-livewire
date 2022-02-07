@props(['active', 'iconName'])

@php
$iconClass = ($active ?? false)
            ? 'fill-white'
            : 'fill-indigo-400 group-hover:fill-white';

$linkClass = ($active ?? false)
            ? 'text-white'
            : 'text-indigo-300 group-hover:text-white'
@endphp

<div class="mb-4">
    <a class="group flex items-center py-3" {{ $attributes->whereStartsWith('href') }}>
      <x-icon name="{{ $iconName }}" class="mr-2 w-4 h-4 {{ $iconClass }}" />
      <div class="{{ $linkClass }}">{{ $slot }}</div>
    </a>
</div>