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
            $table->bigIncrements('id');
            $table->foreignId('entity_id');
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('postal_code');
            $table->string('mobile_phone');
            $table->string('nif');
            $table->string('coupon',64);
            $table->decimal('discount');
            $table->decimal('sub_total');
            $table->decimal('iva_value');
            $table->smallInteger('payment_method');
            $table->string('notes');
            $table->string('mb_entity',5);
            $table->string('mb_ref',9);
            $table->date('mb_limit_date');
            $table->string('mbway_ref',25);
            $table->string('mbway_alias',26);
            $table->string('payment_ref',64);
            $table->string('invoice_id',64);
            $table->string('invoice_link',255);
            $table->date('payment_limit_date');
            $table->smallInteger('invoice_status');
            $table->smallInteger('state');
            $table->timestamps();

            $table->foreign('entity_id')
                ->references('id')
                ->on('entities')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('orders');
    }
}
