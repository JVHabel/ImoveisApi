<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteImoveis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('imovel_id')->index();
            $table->unsignedBigInteger('interessado_id')->index();

            $table->foreign('interessado_id')->references('id')->on('interessados')->onDelete('cascade');
            $table->foreign('imovel_id')->references('id')->on('imoveis')->onDelete('cascade');
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
        Schema::dropIfExists('cliente_imoveis');
    }
}
