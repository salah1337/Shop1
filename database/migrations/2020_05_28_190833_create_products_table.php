<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->softDeletes();

            $table->string('SKU');
            $table->string('name');
            $table->float('price');
            $table->float('weight');
            $table->string('cartDesc');
            $table->string('shortDesc');
            $table->text('longDesc');
            $table->string('thumb');
            $table->string('image');
            $table->float('stock');
            $table->boolean('live');
            $table->boolean('unlimited');
            $table->string('location');
            
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
