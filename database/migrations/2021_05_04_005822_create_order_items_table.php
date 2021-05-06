<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
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
            $table->string('name');
            $table->decimal('price');
            $table->smallInteger('state');
            $table->decimal('reduced_price');
            $table->string('description');
            $table->string('excerpt');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->primary(['entity_id','order_id','product_id']);
            $table->foreignId('entity_id');
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->string('cookie');
            $table->string('name');
            $table->smallInteger('quantity');
            $table->decimal('price');
            $table->string('notes')->nullable();
            $table->decimal('iva');
            $table->smallInteger('state');
            $table->timestamps();

            $table->foreign('entity_id')
                ->references('id')
                ->on('entities')
                ->onDelete('cascade');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('products');
    }
}
