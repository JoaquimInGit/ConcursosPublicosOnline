<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('entity_id');
            $table->string('filter_name');
            $table->smallInteger('filter_state');
            $table->string('description_words')->nullable();
            $table->string('contest_entity')->nullable();
            $table->smallInteger('type_act')->nullable();
            $table->smallInteger('type_model')->nullable();
            $table->smallInteger('type_contract')->nullable();
            $table->decimal('min_price')->nullable();
            $table->decimal('max_price')->nullable();
            $table->string('cpv')->nullable();
            $table->timestamps();

            $table->foreign('entity_id')
                ->references('id')
                ->on('entities')
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
        Schema::dropIfExists('filters');
    }
}
