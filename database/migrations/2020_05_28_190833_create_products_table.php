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

            $table->string('SKU')->unique();
            $table->string('name')->unique();
            $table->float('price');
            $table->float('weight');
            $table->string('cartDesc');
            $table->string('shortDesc');
            $table->text('longDesc');
            $table->string('thumb');
            $table->string('image');
            $table->string('location');
            $table->float('stock');
            $table->boolean('live');
            $table->boolean('unlimited');
            
            $table->bigInteger('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')->on('product_categories');
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
