<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
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
            $table->string('cookie')->nullable();
            $table->string('name');
            $table->smallInteger('quantity');
            $table->decimal('price',12,2);;
            $table->string('notes')->nullable();
            $table->decimal('iva')->default(0.23);
            $table->smallInteger('status')->nullable()
                ->default(1)
                ->comment("1 - waiting order | 2 - ordered");
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
        Schema::dropIfExists('order_item');
    }
}
