<?php
namespace App\DataTables;
use Carbon\Carbon;
use App\Models\Team;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class TeamDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Team> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query = $query->with(['department', 'position']);
        
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function($row) {
                return Carbon::parse($row->created_at)->format('d/m/Y h:i A');
            })
            ->editColumn('department_id', function($row) {
                return $row->department->name ?? 'N/A';
            })
            ->editColumn('positions_id', function($row) {
                return $row->position->title ?? 'N/A';
            })
            ->editColumn('file_name', function($row) {
                if ($row->file_name) {
                    return '<img src="' . asset('storage/' . $row->file_name) . '" alt="Team Member" class="rounded-circle" width="40" height="40">';
                }
                return '<img src="' . asset('images/default-avatar.jpg') . '" alt="Default Avatar" class="rounded-circle" width="40" height="40">';
            })
            ->editColumn('status', function($row) 
            {
                $model = request()->segment(2); // e.g. "teams"
                $toggleUrl = route('status.index', [$model, $row->id]);
                $newStatus = $row->status ? 0 : 1;
                $btnClass = $row->status ? 'btn-success' : 'btn-danger';
                $btnText = $row->status ? 'Active' : 'Inactive';
            
                return '<button class="btn btn-sm '.$btnClass.' change-status" 
                            data-url="'.$toggleUrl.'" 
                            data-status="'.$newStatus.'">'.$btnText.'</button>';
            })
            ->rawColumns(['file_name', 'status', 'action'])
            ->addColumn('action', function($row) {
                return view('Admin.teams.action', compact('row'))->render();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Team>
     */
    public function query(Team $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('team-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true)
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('#')
                ->searchable(false)
                ->orderable(false)
                ->exportable(false),
            Column::make('file_name')
                ->title('Photo')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
                ->title('Name'),
            Column::make('experience')
                ->title('Experience'),
            Column::make('department_id')
                ->title('Department'),
            Column::make('positions_id')
                ->title('Position'),
            Column::make('status')
                ->title('Status'),
            Column::make('created_at')
                ->title('Created At'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Team_' . date('YmdHis');
    }
}
