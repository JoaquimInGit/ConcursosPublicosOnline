<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->string('designation');
            $table->string('country');
            $table->string('district');
            $table->string('address');
            $table->string('postal_code');
            $table->string('mobile_phone');
            $table->string('nif');
            $table->string('cae')->nullable();
            $table->string('cae_secundario')->nullable();
            $table->string('website')->nullable();
            $table->string('email_entity')->nullable();
            $table->smallInteger('state');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::drop('entities');
    }
}
