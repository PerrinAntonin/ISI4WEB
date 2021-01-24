<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CreateCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
               'name'=>'Boissons',
            ],
            [
               'name'=>'Biscuits',
            ],
            [
                'name'=>'Viande',
            ],
            [
                'name'=>'Apero',
            ],
        ];

  

        foreach ($categories as $key => $value) {

            Category::create($value);

        }
    }
}
