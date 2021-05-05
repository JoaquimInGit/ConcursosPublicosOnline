<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests_filters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('contest_id');
            $table->foreignId('filter_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('contest_id')
                ->references('id')
                ->on('contests')
                ->onDelete('cascade');

            $table->foreign('filter_id')
                ->references('id')
                ->on('filters')
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
        Schema::dropIfExists('contests_filters');
    }
}
