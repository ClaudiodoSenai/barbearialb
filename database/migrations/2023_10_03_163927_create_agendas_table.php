<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profissional_id')->unsigned()->nullable(false);
            $table->bigInteger('cliente_id')->nullable();
            $table->bigInteger('servico_id')->nullable();
            $table->dateTime('data_hora')->nullable(false);
            $table->string('tipoPagamento', 20)->nullable();
            $table->decimal('valor')->nullable();
            $table->foreign('profissional_id')->references('id')->on('profissionals'); 
            $table->timestamps(); 
         
        });
          
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
