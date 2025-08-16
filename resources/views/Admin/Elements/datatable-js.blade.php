@push('js')
{{-- JS assets --}}
<x-js-assets :paths="[
    'assets/js/jquery.dataTables.min.js',
    'assets/js/dataTables.bootstrap5.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js',
    'https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js',
    'https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js',

]" />
@endpush