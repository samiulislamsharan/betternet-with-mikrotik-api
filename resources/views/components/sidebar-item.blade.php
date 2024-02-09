

@php
    $classes = ($active ?? false)
                ? 'w-full flex justify-between items-center py-3 px-6 cursor-pointer bg-indigo-50 text-indigo-900 focus:outline-none border-r-4 border-indigo-900'
                : 'w-full flex justify-between items-center py-3 px-6 text-gray-600 cursor-pointer hover:bg-gray-50 hover:text-gray-700 focus:outline-none hover:border-r-4 hover:border-gray-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="flex items-center">
        <span class="mx-2 font-sm">{{ $slot }}</span>
    </span>
</a>
