@push('css')
    {{-- JS assets --}}
    <x-css-assets :paths="[
        'assets/css/dataTables.bootstrap5.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css',
        'https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css',
    ]" />
@endpush