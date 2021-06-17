<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('filter_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->date('date');
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
        Schema::dropIfExists('contest_filter');
    }
}
