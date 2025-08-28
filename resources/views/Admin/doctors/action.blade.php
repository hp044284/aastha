@php
    $Auth_User = auth()->user();
    $Is_Edit = $Auth_User->HasPermission('Doctors', 'Is_Edit');
    $Is_Delete = $Auth_User->HasPermission('Doctors', 'Is_Delete');
@endphp

<div class="btn-group" role="group" aria-label="Actions">
    <button type="button" class="btn btn-info btn-sm me-1" title="Show" onclick="showDoctorOffcanvas({{ $row->id }})">
        <i class="bx bx-show"></i>
    </button>
    @if($Is_Edit)
        <a href="{{ route('doctors.edit', $row->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
            <i class="bx bx-edit"></i>
        </a>
    @endif
    @if($Is_Delete)
        <form action="{{ route('doctors.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                <i class="bx bx-trash"></i>
            </button>
        </form>
    @endif
</div>
