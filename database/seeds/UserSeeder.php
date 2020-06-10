<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Models\Cart;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();
        for ($i=0; $i < rand(3, User::all()->count()); $i++) { 
            $user = User::all()->random();
            $user->assignRole(Role::all()->random());
        };
        $admin = User::create([
            'username' => '1337',
            'email' => '69@1337.com',
            'firstName' => 'admin',
            'lastName' => 'admin',
            'password' => Hash::make('lollol')
        ]);
        $admin->assignRole('admin');
        Cart::create([
            'user_id' => $admin->id,
        ]);
    }
}
