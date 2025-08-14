<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\ProductPrice;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements OnEachRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
        $data = $row->toArray();

        $category = Category::firstOrCreate(
            ['name' => $data['category_name']],
            ['description' => $data['category_description']]
        );

        $subcategory = Product::firstOrCreate(
            [
                'category_id' => $category->id,
                'name' => $data['subcategory_name']
            ],
            ['status' => 1, 'check_remark' => '2']
        );

        ProductPrice::create([
            'category_id'       => $category->id,
            'product_id'        => $subcategory->id,
            'listing_name'      => $data['product_name'],
            'description'       => $data['product_desctiption'],
            'packing_weight'    => $data['packing_weight'],
            'packing_type'      => $data['packing_type'],
            'product_cost'      => $data['product_cost'],
            'offer_price'       => $data['offer_price'],
            'color_name'       => $data['product_color'],
            'code'             => $data['product_code'],
        ]);
    }
}
