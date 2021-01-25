<?php

namespace Database\Seeders;

use App\Models\Custormer;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer=[
            ['firstname'=>'admin',
                'surname'=>'admin',
                'add1'=>'null',
                'postcode'=> 'null',
                'email'=> 'admin@isi.com',
                'phone'=> 'null',
            ],
            ['firstname'=>'Tom',
                'surname'=>'per',
                'add1'=>'226 grande rue de la Guillotiere, Lyon',
                'postcode'=> '38500',
                'email'=> 'user@isi.com',
                'phone'=> '0687956458',
                ],

        ];

        $user = [
            [
               'email'=>'admin@isi.com',
                'is_admin'=>'1',
                'custormer_id'=>'1',
               'password'=> bcrypt('12345678'),
            ],
            [
                'email'=>'user@isi.com',
                'custormer_id'=>'2',
                'is_admin'=>'0',
               'password'=> bcrypt('12345678'),
            ],
        ];


        foreach ($customer as $key => $value) {
            Custormer::create($value);
        }
        foreach ($user as $key => $value) {
            User::create($value);
        }

    }
}
