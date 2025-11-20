@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-red-500 mb-3 text-sm space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <div>{{ $message }}</div>
        @endforeach
    </div>
@endif
