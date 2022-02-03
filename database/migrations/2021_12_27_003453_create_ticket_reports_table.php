<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_report');
            $table->date('date')->nullable();
            $table->longText('ticket_report')->nullable();
            $table->timestamps();

            $table->foreign('user_report')
            ->references('id')
            ->on('users')
            ->onDelete('restrict');
        });
    }
    /**
     * references: id es el campo de la tabla que hace referencia 
     * on users es la tabla
     * onDelete es la acción que realiza el acto relacionado, restrict es que restringe la acción, 
     * no borra el usuario que ya este vinculado al id, para que no afecte a las bases de datos relacionadas
     * porque ya estaba una inserción vinculada del id de referencia
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_reports');
    }
}
