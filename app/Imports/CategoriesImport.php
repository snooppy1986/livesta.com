<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'title'=> $row['title'],
            'translit'=> str_slug($row['title'], '-'),
            'parent_id'=> $row['parent_id'],
            'custom_id' => $row['id'],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $parent_id = Category::query()->where('custom_id', $row['parent_id'])->first('id');

            Category::create([
                'title'=> $row['title'],
                'translit'=> str_slug($row['title'], '-'),
                'parent_id'=>  isset($parent_id) ? $parent_id->id : 0,
                'custom_id'=>intval($row['id'])
            ]);
        }
    }
}
