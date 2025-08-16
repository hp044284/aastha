<?php
namespace App\DataTables;
use Carbon\Carbon;
use App\Models\Position;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PositionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Position> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function($row) {
                return Carbon::parse($row->created_at)->format('d/m/Y h:i A');
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
                return view('Admin.positions.action', compact('row'))->render();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Position>
     */
    public function query(Position $model): QueryBuilder
    {
        $query = $model->newQuery();

        if ($title = request('title')) 
        {
            $query->where('title', 'like', '%' . $title . '%');
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('position-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(3)
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
            Column::make('title'),
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
        return 'Position_' . date('YmdHis');
    }
}
