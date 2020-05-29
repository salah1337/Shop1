<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Option;
use App\OptionGroup;
use Faker\Generator as Faker;

$factory->define(Option::class, function (Faker $faker) {
    
    $options = array (
        array('colors', 'red', 'green', 'blue'),
        array('sizes', 'small', 'medium', 'large'),
        array('models', 'x20', 'x220', 'x420')
    );

    $optionsGroupsCount = sizeof($options) - 1 ;
    $optionsCount = sizeof($options[0]) - 1;

    $index1 = rand(0, $optionsGroupsCount);
    $index2 = rand(1, $optionsCount);
    
    echo($options[$index1][$index2]);

    $OptionGroup = OptionGroup::where('name', $options[$index1][0]);
    return [
        //
        'name' => $options[$index1][$index2],
        'optiongroup_id' => $OptionGroup->id
    ];
});
