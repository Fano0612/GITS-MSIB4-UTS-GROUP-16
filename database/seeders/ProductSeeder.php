<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\products;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $faker = Faker::create('id_ID');
        // for ($i=1; $i <50; $i++){
            products::create([
                // Storage::fake('avatars');
                'product_id' => random_bytes(6),
                'product_name' => $faker->name(),	
                'product_price'	=> random_int(1,10)*100000,
                'product_stock'	=> $faker->numberBetween(1, 100),
                'product_picture' => $faker->image(storage_path('app\public\avatars'),50,50,null,false),	
                'category_id' => $faker->numberBetween(1, 50),

            ]);
        }
    }