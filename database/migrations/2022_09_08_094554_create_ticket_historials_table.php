<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_historials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_ticket')->nullable();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_ticket')->references('id')->on('tickets')->onDelete('set null');

            $table->date('fecha');
            $table->string('motivo');
            $table->string('detalles');
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
        Schema::dropIfExists('ticket_historials');
    }
}
