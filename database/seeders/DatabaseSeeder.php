<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("123456"),
            'is_admin' => 1
        ]);

        \App\Models\User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make("123456"),
            'is_admin' => 0
        ]);

        DB::table('providers')->insert([
            'name' => 'DryFruits',
            'country' => 'VietNam',
            'logo' => 'kkk'
        ]);

        DB::table('products')->insert([
            'name' => 'DryFruits',
            'description' => 'VietNam',
            'price' => 20000,
            'type' => 'Bonsai',
        ]);

        DB::table('images')->insert([
            'url' => 'caythong.jpg',
        ]);


        DB::table('products')->insert([
            'name' => 'DryFruits',
            'description' => 'VietNam',
            'price' => 20000,
            'type' => 'Bonsai',
   
        ]);

        
        DB::table('cart')->insert([
            'user_id' => 8
        ]);

        DB::table('cart_item')->insert([
            'quantity' => 1,
            'product_id' => 10000,
            'cart_id' => 1,
            'price' => 20000
        ]);


    }
}
