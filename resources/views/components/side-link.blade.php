@props(['active'])

@php
    $linkClasses = ($active ?? false)
                    ? 'block px-2 py-2 text-customColor font-medium bg-gray-100 text-customColor rounded-lg'
                    : 'block px-2 py-2 text-gray-600 font-medium hover:bg-gray-100 rounded-lg';
@endphp

<a {{ $attributes->merge(['class' => $linkClasses]) }}>
    {{ $slot }}
</a>
