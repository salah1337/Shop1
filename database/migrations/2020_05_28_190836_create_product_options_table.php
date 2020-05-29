<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->float('priceIncrement');
            $table->bigInteger('option_id')->unsigned();
            $table->bigInteger('option_group_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('option_id')->references('id')->on('options');
            $table->foreign('option_group_id')->references('id')->on('option_groups');
            $table->foreign('product_id')->references('id')->on('products')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
}
