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
        Schema::create('contests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num_announcement')->unique();
            $table->text('description');
            $table->string('entity');
            $table->tinyInteger('type_act')->nullable()->default(1)->comment(
                "0 - Todos | 1 - Anúncio de procedimento | 2 - Anúncio de concurso urgente | 3 - Declaração de retificação de anúncio | 4 - Aviso de prorrogação de prazo"
            );
            $table->smallInteger('type_model');
            $table->smallInteger('type_contract');
            $table->decimal('price')->nullable();
            $table->date('publication_date');
            $table->string('deadline');
            $table->smallInteger('state');
            $table->string('republic_diary');
            $table->string('cpv');
            $table->text('cpv_description');
            $table->string('procedure_parts')->nullable();
            $table->json('pdf_content')->nullable();
            $table->timestamps();
        });

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
        Schema::dropIfExists('contests');
    }
}
