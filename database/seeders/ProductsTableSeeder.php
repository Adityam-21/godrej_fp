<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Refrigerator',
                'category' => 'Home Appliances',
                'subcategory' => 'Cooling',
                'page_slug' => 'refrigerator',
                'status' => 1, 
                'description' => 'High-quality energy efficient refrigerator for your home.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Air Conditioner',
                'category' => 'Home Appliances',
                'subcategory' => 'Cooling',
                'page_slug' => 'air-conditioner',
                'status' => 1, 
                'description' => 'Powerful split AC with fast cooling and energy saving features.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Washing Machine',
                'category' => 'Home Appliances',
                'subcategory' => 'Laundry',
                'page_slug' => 'washing-machine',
                'status' => 1, // ✅
                'description' => 'Front-load washing machine with smart inverter technology.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
