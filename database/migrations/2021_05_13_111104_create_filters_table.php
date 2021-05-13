<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->string('filter_name');
            $table->string('description_words')->nullable();
            $table->string('contest_entity')->nullable();
            $table->string('district')->nullable();
            $table->decimal('min_price')->nullable();
            $table->decimal('max_price')->nullable();
            $table->string('cpv')->nullable();
            $table->tinyInteger('type_act')->comment(
                "0 - Todos | 1 - Anúncio de procedimento | 2 - Anúncio de concurso urgente
                | 3 - Declaração de retificação de anúncio | 4 - Aviso de prorrogação de prazo"
            );
            $table->tinyInteger('type_model')->comment(
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
            $table->tinyInteger('type_contract')->comment(
                "0 - Todos | 1 - Aquisição de bens móveis | 2 - Aquisição de serviços
                | 3 - Concessão de obras públicas | 4 - Concessão de serviços públicos
                | 5 - Empreitadas de obras públicas | 6 - Localização de bens móveis
                | 7 - Sociedade | 8 - Outros
            ");
            $table->tinyInteger('filter_status')->comment(
                "0 - filtro inativo | 1 - ativo com notificações | 2 - ativo sem notificações"
            );
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
        Schema::dropIfExists('filters');
    }
}
