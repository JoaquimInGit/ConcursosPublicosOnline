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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('order_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->string('cookie');
            $table->string('name');
            $table->smallInteger('quantity');
            $table->decimal('price');
            $table->string('notes')->nullable();
            $table->decimal('iva')->default(0.23);
            $table->smallInteger('status')->nullable();
            $table->timestamps();
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
    }
}
