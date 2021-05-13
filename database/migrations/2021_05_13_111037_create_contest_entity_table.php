<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_entity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('entity_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('follow')->nullable()->default(false);
            $table->timestamp('viewed_at')->nullable();
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
        Schema::dropIfExists('contest_entity');
    }
}
