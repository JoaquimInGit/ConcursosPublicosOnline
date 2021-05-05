<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
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
            $table->smallInteger('type_act');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contests');
    }
}
