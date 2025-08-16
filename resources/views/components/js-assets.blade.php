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
        <script src="{{ $isExternal ? $path : asset($path) }}"></script>
    @endif
@endforeach
