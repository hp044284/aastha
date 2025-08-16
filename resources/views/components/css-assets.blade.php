@foreach ($paths as $path)
    @php
        $path = trim($path);
        $isExternal = str_starts_with($path, 'http') || str_starts_with($path, '//');
        $isVite = str_starts_with($path, 'vite:');
        $vitePath = str_replace('vite:', '', $path);
    @endphp

    @if ($isVite)
        @vite($vitePath)
    @else
        <link rel="stylesheet" href="{{ $isExternal ? $path : asset($path) }}">
    @endif
@endforeach