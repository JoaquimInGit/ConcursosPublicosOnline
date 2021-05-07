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
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->string('designation');
            $table->string('country');
            $table->string('district');
            $table->string('address');
            $table->string('postal_code',8);
            $table->string('mobile_phone',12);
            $table->string('nif',9);
            $table->string('cae',5)->nullable();
            $table->string('cae_secundario')->nullable();
            $table->string('website')->nullable();
            $table->string('email_entity')->nullable();
            $table->tinyInteger('status')->default(1)->comment(
                "0 - entidade inativa  | 1 - entidade ativa
            ");
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
        Schema::drop('entities');
    }
}
