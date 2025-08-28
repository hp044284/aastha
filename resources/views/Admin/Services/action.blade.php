<div class="btn-group" role="group" aria-label="Actions">
    <button type="button" class="btn btn-info btn-sm me-1" title="Show" onclick="showServiceOffcanvas({{ $row->id }})">
        <i class="bx bx-show"></i>
    </button>
    <a href="{{ route('services.edit', $row->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
        <i class="bx bx-edit"></i>
    </a>
    <form action="{{ route('services.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this service?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
            <i class="bx bx-trash"></i>
        </button>
    </form>
</div>
