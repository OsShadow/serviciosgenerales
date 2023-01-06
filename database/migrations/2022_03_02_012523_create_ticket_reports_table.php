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
            $table->unsignedBigInteger('user_code');
            $table->enum('type',array('Abierto','Ejecutando','Cerrado'));
            $table->enum('priority',array('Alta','Media','Baja'));
            $table->date('date');
            $table->longText('ticket_report');
            $table->date('closed_at');
            $table->date('date_finish');
            $table->time('hour_finish');
            $table->timestamps();

            // $table->foreign('user_report')
            // ->references('id')
            // ->on('users')
            // ->onDelete('cascade');

            // $table->foreign('user_code')
            // ->references('id')
            // ->on('users')
            // ->onDelete('cascade');
        });
    }

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
