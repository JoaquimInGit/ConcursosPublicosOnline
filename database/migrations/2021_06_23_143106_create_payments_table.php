<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->default(NULL)->constrained()->onDelete('cascade');
            $table->decimal('value', 10,2)->nullable(false);
            $table->string('currency', 3)->nullable(false)->default('EUR');
            $table->smallInteger('payment_method')->nullable(false)->default(0)->comment('0 - unknown | 1 - Ref MB | 2 - MBWAY | 3 - direct debit | 4- Wire transfer | 5 - money');
            $table->string('transaction_id', 64)->nullable();
            $table->text('raw_data')->nullable();
            $table->smallInteger('status')->nullable(false)->default(1)->comment('1 - payment completed | 2 - payment failed')->index();
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
        Schema::dropIfExists('payments');
    }
}
