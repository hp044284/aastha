<div class="btn-group" role="group" aria-label="Actions">
    <a href="{{ route('teams.show', $row->id) }}" class="btn btn-info btn-sm me-1" title="Show">
        <i class="bx bx-show"></i>
    </a>
    <a href="{{ route('teams.edit', $row->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
        <i class="bx bx-edit"></i>
    </a>
    <form action="{{ route('teams.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this team member?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
            <i class="bx bx-trash"></i>
        </button>
    </form>
</div>
