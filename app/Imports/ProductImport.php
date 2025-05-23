<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row['product_name'],
            'subcategory' => $row['subcategory'],
            'category' => $row['category'],
            'price' => $row['price'],
            'status' => $row['status'],
        ]);
    }
}
