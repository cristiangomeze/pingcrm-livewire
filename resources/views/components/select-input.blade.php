@props(['id', 'error' => '', 'disabled' => false])

@php
$id = $id ?? md5($attributes->wire('model') . \Str::random(10))
@endphp

<div class="{{ $attributes->get('class') }}">
    @if($attributes->has('label'))
    <label class="form-label" for="{{ $id }}">{{ $attributes->get('label') }}:</label>
    @endif
    <select id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->whereDoesntStartWith('class') }} class="form-select @error($error) error @enderror">
        {{ $slot }}
    </select>
    @error($error)
    <div class="form-error">{{ $message }}</div>
    @enderror
</div>