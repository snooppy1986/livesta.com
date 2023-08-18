<?php

namespace App\Imports;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {

            $cat_id = Category::query()
                ->where('custom_id', $row['category_id'])
                ->first();
            $brand = Brand::query()->where('title', $row['brand'])->value('id');
            /*dd($row, $brand, $cat_id);*/
            $product = Product::create([
                'title'=>trim($row['title']),
                'image'=>$row['image'] ?? '',
                'content'=>trim($row['about']),
                'code'=> $row['code'],
                'price_balls'=> $row['price_balls'],
                'price_discount' => str_replace(' ', '', $row['price_discount']),
                'price_special' => str_replace(' ', '', $row['price_special']),
                'price_through' => str_replace(' ', '', $row['price_through']),
                'rating' => $row['rating'],
                'brand_id' =>  $brand
            ]);

            $product->category()->attach($cat_id);

            $product->attributes()->create([
                'application'=> $row['aplication'],
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
