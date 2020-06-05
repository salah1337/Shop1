<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Ability;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'label' => 'Admin'
        ]);
        $roles = [
            ['general-manager', 'general Manager'],
            ['sales-manager', 'sales Manager'],
            ['option-manager', 'option Manager'],
            ['product-manager', 'product Manager'],
            ['user-manager', 'user Manager'],
            ['order-manager', 'order Manager'],
            ['sales-man', 'salesman'],
            ['employee', 'employee'],
        ];
        foreach ($roles as $key => $role) {
            $createdRole = Role::create([
                'name' => $role[0],
                'label' => $role[1]
            ]);
            for ($i=0; $i < 2; $i++) {
                $ability = Ability::all()->random()->id;
                if (!$createdRole->ableTo($ability)) {
                    $createdRole->allowTo($ability);
                };
            };
        };
    }
}
