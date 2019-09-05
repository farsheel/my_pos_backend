<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class FakeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) {
            factory(Product::class, 10000)
                ->create();
        }
    }
}
