@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-customColor text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-customFocusColor transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-customHoverColor focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-customFocusColor transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
