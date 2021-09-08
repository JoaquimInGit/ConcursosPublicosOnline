<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoloni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('moloni_category_id',32)->nullable();
            $table->string('moloni_product_id',32)->after('moloni_category_id')->nullable();
            $table->string('moloni_tax_id',32)->after('moloni_product_id')->nullable();
            $table->decimal('vat', 12, 2);
        });

        Schema::table('order_item', function (Blueprint $table) {
            $table->decimal('vat', 12, 2);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('vat_value', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('moloni_category_id');
            $table->dropColumn('moloni_product_id');
            $table->dropColumn('moloni_tax_id');;
            $table->dropColumn('vat');
        });

        Schema::table('order_item', function (Blueprint $table) {
            $table->dropColumn('vat');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('vat_value');
        });
    }
}
