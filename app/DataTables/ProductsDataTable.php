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
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('edit', function ($product){
                $btn = '<a href="javascript:showProduct('.$product->id.')" class="product-show btn btn-info btn-sm mr-1""><i class="fa fa-eye" aria-hidden="true"></i></a>';
                $btn = $btn.'<a href="'.route('product.edit', $product->id).'" class="product-edit btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i></a>';
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

    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

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
                    ]);

    }

    public function getColumns(): array
    {
        return [
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

    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
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
