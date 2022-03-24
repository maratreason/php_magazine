<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'description' => 'Для самых смелых идей',
                'image' => 'products/product10.jpg',
                'price' => 11000,
                'category_id' => 3,
            ],
            [
                'name' => 'Часы ручные',
                'code' => 'watches-man-white',
                'description' => 'Для самых смелых идей',
                'image' => 'products/product1.png',
                'price' => 5000,
                'category_id' => 3,
            ],
            [
                'name' => 'Рюкзак',
                'code' => 'sumka',
                'description' => 'Рюкзак',
                'image' => 'products/product5.png',
                'price' => 5000,
                'category_id' => 1,
            ],
            [
                'name' => 'iPhone X 64GB',
                'code' => 'iphone_x_64',
                'description' => 'Отличный продвинутый телефон с памятью на 64 gb',
                'image' => 'products/product1.jpg',
                'price' => 62990,
                'category_id' => 5,
            ],
            [
                'name' => 'iPhone X 256GB',
                'code' => 'iphone_x_256',
                'description' => 'Отличный продвинутый телефон с памятью на 256 gb',
                'image' => 'products/product2.jpg',
                'price' => 54990,
                'category_id' => 5,
            ],
            [
                'name' => 'HTC One S',
                'code' => 'htc_one_s',
                'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                'image' => 'products/product3.jpg',
                'price' => 11000,
                'category_id' => 5,
            ],
        ]);
    }
}
