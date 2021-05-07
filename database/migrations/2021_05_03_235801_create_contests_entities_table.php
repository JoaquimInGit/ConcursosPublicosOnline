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
            $table->id();
            $table->integer("base_id")->unique();
            $table->string('num_announcement')->nullable()->unique();
            $table->text('description');
            $table->string('entity');
            $table->tinyInteger('type_act')->nullable()->default(1)->comment(
                "0 - Todos | 1 - Anúncio de procedimento | 2 - Anúncio de concurso urgente
                | 3 - Declaração de retificação de anúncio | 4 - Aviso de prorrogação de prazo"
            );
            $table->tinyInteger('type_model')->nullable()->default(1)->comment(
                "0 - Todos | 1 - Concursos público | 2 - Concursos público urgente
                | 3 - Concursos limitado por prévia qualificação | 4 - Procedimento de negociação
                | 5 - Diálogo concorrencial | 6 - Concurso de concepção | 7 - Anúncio simplificado
                | 8 - Instituição de sistema de qualificação
                | 9 - Intenção de celebração de empreitadas de obras publicas por concessionários que não sejam entidades adjudicantes
                | 10 - Parceria para a inovação | 11 - Concurso de ideias
                | 12 - Instituição de sistema de aquisição dinâmico
                | 13 - Hasta Pública de Alienaçãode Bens Móveis
                | 14 - Aquisição de Serviços Sociais e de Outros Serviços Específicos
                | 15 - Anúncio de Adjudicação de Aquisição de Serviços Sociais e de Outros Serviços Específicos"
            );
            $table->tinyInteger('type_contract')->nullable()->default(1)->comment(
                "0 - Todos | 1 - Aquisição de bens móveis | 2 - Aquisição de serviços
                | 3 - Concessão de obras públicas | 4 - Concessão de serviços públicos
                | 5 - Empreitadas de obras públicas | 6 - Localização de bens móveis
                | 7 - Sociedade | 8 - Outros
            ");
            $table->decimal('price')->nullable();
            $table->date('publication_date');
            $table->date('deadline_date');
            $table->tinyInteger('status')->default(1)->comment(
                "0 - fora do prazo | 1 - dentro do prazo
            ");
            $table->integer('republic_diary_num')->nullable();
            $table->integer('republic_diary_serie')->nullable();
            $table->string('cpv')->nullable();
            $table->text('cpv_description')->nullable();
            $table->string('procedure_parts')->nullable();
            $table->string("link_announcement")->nullable();
            $table->json('pdf_content')->nullable();
            $table->timestamps();
        });

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
        Schema::dropIfExists('contests');
    }
}
