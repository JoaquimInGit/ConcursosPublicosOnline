<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests_entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('contest_id');
            $table->foreignId('entity_id');
            $table->boolean('follow');
            $table->boolean('viewed');
            $table->timestamps();

            $table->foreign('contest_id')
                ->references('id')
                ->on('contests')
                ->onDelete('cascade');

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
        Schema::dropIfExists('contests_entities');
    }
}
