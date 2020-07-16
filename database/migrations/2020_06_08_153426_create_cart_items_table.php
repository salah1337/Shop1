<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name');
            $table->string('image');
            $table->longText('options');
            $table->longText('description');
            $table->integer('count');
            $table->integer('tax');
            $table->float('price');
            $table->bigInteger('cart_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->foreign('cart_id')->references('id')->on('carts')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
