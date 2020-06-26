<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Categories = array (
            ['name' => 'T-shirts', 'icon' => 'portrait'],
            ['name' => 'Cars', 'icon' => 'portrait'],
            ['name' => 'Laptops', 'icon' => 'portrait'],
        );

        foreach ($Categories as $Category) {
            DB::table('product_categories')->insert([
                'name' => $Category['name'],
                'icon' => $Category['icon'],
            ]);
        }
    }
}
