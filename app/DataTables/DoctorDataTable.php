<?php
namespace App\DataTables;
use Carbon\Carbon;
use App\Models\Doctor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class DoctorDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Doctor> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query = $query->with('position');
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function($row) {
                return Carbon::parse($row->created_at)->format('d/m/Y h:i A');
            })
            ->editColumn('position_id', function($row) {
                return $row->position->title ?? '';
            })
            ->editColumn('status', function($row) 
            {
                $model = request()->segment(2); // e.g. "specializations"
                $toggleUrl = route('status.index', [$model, $row->id]);
                $newStatus = $row->status ? 0 : 1;
                $btnClass = $row->status ? 'btn-success' : 'btn-danger';
                $btnText = $row->status ? 'Active' : 'Inactive';
            
                return '<button class="btn btn-sm '.$btnClass.' change-status" 
                            data-url="'.$toggleUrl.'" 
                            data-status="'.$newStatus.'">'.$btnText.'</button>';
            })
            ->rawColumns(['status','action'])
            ->addColumn('action', function($row) {
                return view('Admin.doctors.action', compact('row'))->render();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Doctor>
     */
    public function query(Doctor $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('doctor-table')
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
            Column::make('name'),
            Column::make('position_id'),
            Column::make('affiliation'),
            Column::make('status'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Doctor_' . date('YmdHis');
    }
}
