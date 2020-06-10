<?php

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\User;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < User::all()->count(); $i++) { 
            Cart::create([
                'user_id' => User::find($i)->id,
            ]);
        };
    }
}
