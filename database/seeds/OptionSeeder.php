<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Option::class, 9)->create();

        // $options = array (
        //     array('colors', 'red', 'green', 'blue'),
        //     array('sizes', 'small', 'medium', 'large'),
        //     array('models', 'x20', 'x220', 'x420')
        // );

        // $colors = ['colors', 'red', 'green', 'blue'];
        // $sizes = ['small', 'medium', 'large'];
    }
}
