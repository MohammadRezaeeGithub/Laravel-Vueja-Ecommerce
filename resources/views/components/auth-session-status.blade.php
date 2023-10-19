@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm bg-emerald-600 text-white text-green-600']) }}>
        {{ $status }}
    </div>
@endif
