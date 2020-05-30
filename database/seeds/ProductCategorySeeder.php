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
            'T-shirts',
            'Cars',
            'Laptops',
        );

        foreach ($Categories as $Category) {
            DB::table('product_categories')->insert([
                'name' => $Category,
            ]);
        }
    }
}
