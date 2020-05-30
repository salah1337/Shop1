<?php

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
        $this->call(UserSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(OptionGroupSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
