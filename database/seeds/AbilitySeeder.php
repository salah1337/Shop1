<?php

use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abilities = [
            ['store-optionGroup', 'create option groups'],
            ['store-option', 'create options'],
            ['store-orderDetail', 'create order details for existing orders'],
            ['store-order', 'place orders'],
            ['store-productCategory', 'create product categories'],
            ['store-productOption', 'create product options'],
            ['store-product', 'create products'],
            ['store-user', 'create users'],
            
            ['update-optionGroup', 'update option groups'],
            ['update-option', 'update options'],
            ['update-orderDetail', 'update order details for existing orders'],
            ['update-productCategory', 'update product categories'],
            ['update-productOption', 'update product options'],
            ['update-product', 'update products'],
            ['update-user', 'update users'],
            
            ['delete-optionGroup', 'delete option groups'],
            ['delete-option', 'delete options'],
            ['delete-orderDetail', 'delete order details for existing orders'],
            ['delete-order', 'cancel orders'],
            ['delete-productCategory', 'delete product categories'],
            ['delete-productOption', 'delete product options'],
            ['delete-product', 'delete products'],
            ['delete-user', 'delete users'],

        ];

        foreach ($abilities as $ability) {
            DB::table('abilities')->insert([
                'name' => $ability[0],
                'label' => $ability[1]
            ]);
        }
    }
}
