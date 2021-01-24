<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'cat_id'=>'1',
                'name'=>'Saveur Impériale',
                'description'=>'Sachet de thé de qualité supérieure.200 sachets par boite',
                'image'=> '',
                'price'=> '4.99',
            ],            
            [
                'cat_id'=>'1',
                'name'=>'Jus d’Orange de Floride',
                'description'=>'Bouteille d’un litre.',
                'image'=> 'bestorange-juice.jpg',
                'price'=> '0.9',
            ],
            
        ];

  

        foreach ($user as $key => $value) {

            Product::create($value);

        }
    }
}
