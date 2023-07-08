<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('edit', function ($product){
                $btn = '<a href="javascript:showProduct('.$product->id.')" class="product-show btn btn-info btn-sm mr-1""><i class="fa fa-eye" aria-hidden="true"></i></a>';
                $btn = $btn.'<a href="'.route('product.edit', $product).'" class="product-edit btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i></a>';
                $btn = $btn.'<a  href="javascript:deleteProduct('.$product->id.')" class="product-remove btn btn-danger btn-sm" data-id="'.$product->id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>';

                return $btn;
            })
            ->addColumn('image', function ($product){
                $url = asset('storage/images/'.$product->image);
                return '<img src="'.$url.'" width="100">';
            })

            ->rawColumns(['edit', 'action', 'image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'language' => [
                            'url' => url('/vendor/data-table/lang/'.config('app.locale').'.json'),//<--here
                        ],
                        'order'=>[
                          0, 'asc'
                        ],
                    ])
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
            /*Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),*/
            Column::make('id'),
            Column::computed('image')
                ->title('Зображення')
                ->exportable(false)
                ->printable(false)
                ->width(150),
            Column::make('title')->title('Назва'),
            Column::make('code')->title('Код'),
            Column::make('price_balls')->title('Бали'),
            Column::make('price_special')->title('Ціна'),
            Column::computed('edit')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }

    /**
     * @inheritDoc
     */
    public function excel()
    {
        // TODO: Implement excel() method.
    }

    /**
     * @inheritDoc
     */
    public function csv()
    {
        // TODO: Implement csv() method.
    }

    /**
     * @inheritDoc
     */
    public function pdf()
    {
        // TODO: Implement pdf() method.
    }
}
