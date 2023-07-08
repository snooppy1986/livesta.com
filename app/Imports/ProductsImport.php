<?php

namespace App\Imports;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([

        ]);
    }

    /**
     * @inheritDoc
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $category = Category::where('custom_id', $row['category_id'])->first('id');
            $product = Product::create([
                'title'=>trim($row['title']),
                'image'=>$row['image'],
                'content'=>trim($row['about']),
                'category'=> $category ? $category->id : 0,
                'code'=> $row['code'],
                'price_balls'=> $row['price_balls'],
                'price_discount' => $row['price_discount'],
                'price_special' => $row['price_special'],
                'price_through' => $row['price_through'],
                'rating' => $row['rating'],
            ]);

            CategoryProduct::create([
                'category_id' => $category ? $category->id : 0,
                'product_id' => $product->id
            ]);

            Attribute::create([
                'product_id' => $product->id,
                'application'=> $row['aplication'],
                'brand' => $row['brand'],
                'country' => $row['country'],
                'composition' => $row['composition'],
                'gender' => $row['gender'],
                'catalog_id' => $row['id'],
                'warning' => $row['warning'],
                'weight' => $row['weight']
             ]);
        }
    }
}
