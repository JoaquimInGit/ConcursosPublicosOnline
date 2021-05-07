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
            $table->id();
            $table->foreignId('contest_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('entity_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->boolean('follow');
            $table->boolean('viewed');
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
        Schema::dropIfExists('contests_entities');
    }
}
