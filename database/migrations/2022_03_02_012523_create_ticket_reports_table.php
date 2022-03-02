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
            $table->unsignedBigInteger('id_status');
            $table->date('date');
            $table->longText('ticket_report');
            $table->text('employer');
            $table->date('date_finish');
            $table->timestamps();

            $table->foreign('id_status')
            ->references('id')
            ->on('ticket_statuses')
            ->onDelete('restrict');

            $table->foreign('user_report')
            ->references('id')
            ->on('users')
            ->onDelete('restrict');
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
