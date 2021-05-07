<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('postal_code');
            $table->string('mobile_phone')->nullable();
            $table->string('nif')->nullable();
            $table->string('coupon',64)->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('sub_total');
            $table->decimal('iva_value');
            $table->tinyInteger('payment_method')
                ->nullable()
                ->default(0)
                ->comment("0 - referencia multibanco | 1 - paypal | 2 - mbway");
            $table->string('notes')->nullable();
            $table->string('mb_entity',5)->nullable();
            $table->string('mb_ref',9)->nullable();
            $table->date('mb_limit_date')->nullable();
            $table->string('mbway_ref',25)->nullable();
            $table->string('mbway_alias',26)->nullable();
            $table->string('payment_ref',64)->nullable();
            $table->string('invoice_id',64)->nullable();
            $table->string('invoice_link',255)->nullable();
            $table->date('payment_limit_date')->nullable();
            $table->smallInteger('invoice_status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
