@php
    $Auth_User = auth()->user();
    $Is_Edit = $Auth_User->HasPermission('Testimonials', 'Is_Edit');
    $Is_Delete = $Auth_User->HasPermission('Testimonials', 'Is_Delete');
@endphp

<div class="btn-group" role="group" aria-label="Actions">
    <a href="{{ route('testimonials.show', $row->id) }}" class="btn btn-info btn-sm me-1" title="Show">
        <i class="bx bx-show"></i>
    </a>
    @if($Is_Edit)
        <a href="{{ route('testimonials.edit', $row->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
            <i class="bx bx-edit"></i>
        </a>
    @endif
    @if($Is_Delete)
        <form action="{{ route('testimonials.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                <i class="bx bx-trash"></i>
            </button>
        </form>
    @endif
</div>
