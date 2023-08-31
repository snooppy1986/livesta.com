<?php

namespace App\DataTables;

use App\Models\NewsLetter;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NewsLetterDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->addColumn('delete', function ($newsletter){
                $btn = '<a  href="javascript:deleteNewsLetter('.$newsletter->id.')" class="product-remove btn btn-danger btn-sm" data-id="'.$newsletter->id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                return $btn;
            })
            ->addColumn('status', function ($newsletter){
                $status = $newsletter->status ? 'checked' : '';
                $btn = "<input
                            class=\"newsletter-status\"
                            type=\"checkbox\"
                            name=\"my-checkbox\"
                            data-id=\"$newsletter->id\"
                            $status
                            data-bootstrap-switch
                            data-off-color=\"danger\" data-on-color=\"success\">";
                return $btn;
            })
            ->rawColumns(['delete', 'status'])
            ->setRowId('id');
    }

    public function query(NewsLetter $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {

        return $this->builder()
                    ->setTableId('newsletter-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'language' => [
                            'url' => url('/vendor/data-table/lang/'.config('app.locale').'.json'),//<--here
                        ],

                        'drawCallback' => 'function() {
                                status();
                            }',
                    ])
                    ->paging(false)
                    ->pageLength(50)
            ;

    }

    public function getColumns(): array
    {
        return [
            Column::make('email')->title('Email'),
            Column::computed('status')
                ->orderable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->title('Статус'),
            Column::computed('delete')
                ->title('Видалити')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Newsletter_' . date('YmdHis');
    }

    public function excel()
    {
        // TODO: Implement excel() method.
    }

    public function csv()
    {
        // TODO: Implement csv() method.
    }

    public function pdf()
    {
        // TODO: Implement pdf() method.
    }
}
