<?php

namespace App\DataTables;

use App\Models\Location;
use App\Models\Operability;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class OperabilityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables($query)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('code', function ($row) {
                return $row->code;
            })
            ->addColumn('name', function ($row) {
                return $row->details;
            })
            ->addColumn('status', function ($row) {
                return $row->operabilityType->description;
            })
            ->addColumn('action', function ($row) {
                $action = '<div class="d-flex justify-content-around">';
                $action .= '  <a href="' . route('operability.edit', ['operability' => $row->id]) . '"
            type="button"
            class="btn btn-success text-white font-weight-bold py-1 rounded text-center"><i
                class="fas fa-edit"></i></a>';

                if (auth()->user()->user_type_id === 1) {
                    $action .='<form action="'.route('operability.delete',$row->id).'" method="POST"><input type="hidden" name="_token" value="'.csrf_token().'" />';
                    $action .= '<button type="button" class="btn btn-danger text-white py-1 rounded text-center ml-2 delete-btn" data-id="'.$row->id.'">
                            <i class="fas fa-trash"></i>
                        </button></form>';
            $action.='</div>';
        return $action;
                }
            })->rawColumns(['id', 'code', 'name', 'status','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Operability $model): QueryBuilder
    {
        return $model->select('operabilities.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('operability-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->language([
                'decimal' => '',
                'emptyTable' => 'No hay información',
                'info' => 'Mostrando _START_ a _END_ de _TOTAL_ Entradas',
                'infoEmpty' => 'Mostrando 0 a 0 de 0 Entradas',
                'infoFiltered' => '(Filtrado de _MAX_ total entradas)',
                'infoPostFix' => '',
                'thousands' => ',',
                'lengthMenu' => 'Mostrar _MENU_ Entradas',
                'loadingRecords' => 'Cargando...',
                'processing' => 'Procesando...',
                'search' => 'Buscar:',
                'zeroRecords' => 'Sin resultados encontrados',
                'paginate' => [
                    'first' => 'Primero',
                    'last' => 'Último',
                    'next' => 'Siguiente',
                    'previous' => 'Anterior'
                ]
            ])
            ->initComplete('function() {
                $("#dt-length-0").addClass("form-control custom-select-class");
            }');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            __('id') => ['data' => 'id', 'exportable' => false, 'name' => 'id', 'title' => __('id')],
            __('code') => ['data' => 'code', 'exportable' => false, 'name' => 'code', 'title' => __('Codigo')],
            __('details') => ['data' => 'details', 'exportable' => false, 'name' => 'details', 'title' => __('Detalle')],
            __('status') => ['data' => 'status', 'exportable' => false, 'name' => 'status', 'title' => __('Estado')],
            Column::computed('action',__('Acción'))
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
        return 'Operability_' . date('YmdHis');
    }
}
