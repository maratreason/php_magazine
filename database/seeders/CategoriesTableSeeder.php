<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Мужские',
                'code' => 'Man',
                'description' => 'Мужские товары. Какое-то описание',
            ],
            [
                'name' => 'Женские',
                'code' => 'woman',
                'description' => 'Описание женских товаров',
            ],
            [
                'name' => 'Аксессуары',
                'code' => 'accessories',
                'description' => 'Описание категории аксессуаров',
            ],
            [
                'name' => 'Обувь',
                'code' => 'footwear',
                'description' => 'Описание категории обувь',
            ],
            [
                'name' => 'Электроника',
                'code' => 'electronics',
                'description' => 'Описание категории электроники',
            ],
            [
                'name' => 'Еда',
                'code' => 'food',
                'description' => 'Описание категории еда',
            ],
        ]);
    }
}
