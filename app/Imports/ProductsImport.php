<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row[0],
            'category'     => $row[1],
            'subcategory'  => $row[2],
            'pdf_title'    => $row[3],
            'video_title'  => $row[4],
            'video_link'   => $row[5],
            'page_slug'    => $row[6],
            'status'       => 1,
            'description'  => $row[7] ?? null,
        ]);
    }
}
