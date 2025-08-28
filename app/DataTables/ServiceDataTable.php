<?php
namespace App\DataTables;
use Carbon\Carbon;
use App\Models\Service;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ServiceDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Service> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query->with('serviceCategory');
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function($row) {
                return Carbon::parse($row->created_at)->format('d/m/Y h:i A');
            })
            ->editColumn('category_id', function($row) {
                return $row->serviceCategory->Title ?? '';
            })
            ->editColumn('status', function($row) 
            {
                $model = request()->segment(2); // e.g. "services"
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
                return view('Admin.services.action', compact('row'))->render();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Service>
     */
    public function query(Service $model): QueryBuilder
    {
        $query = $model->newQuery();
        // Enable searching by action column (e.g., by id or other unique identifier)
        if ($search = request('search')['value'] ?? null) 
        {
            $query->where(function($q) use ($search) 
            {
                $q->whereRaw('LOWER(title) like ?', ['%' . strtolower($search) . '%'])
                  ->orWhereHas('serviceCategory', function($q2) use ($search) {
                      $q2->whereRaw('LOWER(`service_categories`.`Title`) like ?', ['%' . strtolower($search) . '%']);
                  });
            });
        }
        // $query->dd();
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('service-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true)
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
            Column::make('category_id')->title('Category'),
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
        return 'Service_' . date('YmdHis');
    }
}
