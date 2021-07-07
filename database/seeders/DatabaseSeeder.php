<?php

namespace Database\Seeders;

use App\Models\Product;
//use App\Models\Producte;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //\App\Models\User::factory(5)->create();
        Product::factory(5)->create();
        // $this->call(CategoriesTbleseeder::class);
    }
}
