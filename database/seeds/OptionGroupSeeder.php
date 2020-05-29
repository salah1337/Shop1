<?php

use Illuminate\Database\Seeder;

class OptionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $OptionGroups = array (
            'colors',
            'sizes',
            'models',
        );

        foreach ($OptionGroups as $OptionGroup) {
            DB::table('option_groups')->insert([
                'name' => $OptionGroup,
            ]);
        }
        
    }
}
