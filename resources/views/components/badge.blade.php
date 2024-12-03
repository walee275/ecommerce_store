@props(['type', 'size'])

@php
    $color = [
        'default' => 'bg-slate-50 text-slate-600 ring-1 ring-inset ring-slate-500/10 dark:bg-slate-400/10 dark:text-slate-400 dark:ring-slate-400/20',
        'primary' => 'bg-sky-50 text-sky-700 ring-1 ring-inset ring-sky-600/20 dark:bg-sky-400/10 dark:text-sky-400 dark:ring-sky-400/20',
        'success' => 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20',
        'warning' => 'bg-yellow-50 text-yellow-800 ring-1 ring-inset ring-yellow-600/20 dark:bg-yellow-400/10 dark:text-yellow-400 dark:ring-yellow-400/20',
        'danger' => 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10 dark:bg-red-400/10 dark:text-red-400 dark:ring-red-400/20',
    ][$type ?? 'default'];

    $size = [
        'xs' => 'text-xs px-1.5 py-0.5',
        'sm' => 'text-xs px-2 py-1',
    ][$size ?? 'sm'];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full font-medium ' . $color . ' ' . $size]) }}>
    {{ $slot }}
</span>
