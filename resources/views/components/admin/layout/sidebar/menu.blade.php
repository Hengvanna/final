@props([
    'title',
    'icon',
    'route',
    'activePattern' => null,
])

@php
    $isActive = $activePattern ? request()->is($activePattern) : (request()->url() === $route);
@endphp

<li class="nav-item">
    <a href="{{ $route }}" class="nav-link {{ $isActive ? 'active' : '' }}" {{ $attributes }}>
        <i class="{{ $icon }}"></i>
        <p>{{ $title }}</p>
    </a>
</li>
