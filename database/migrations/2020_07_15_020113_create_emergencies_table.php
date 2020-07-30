<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencies', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->date('date');
            $table->longText('description');
            $table->longText('observations');
            $table->unsignedBigInteger('user_area');
            $table->unsignedBigInteger('user_report');
            $table->timestamps();

            $table->foreign('user_area')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('user_report')
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
        Schema::dropIfExists('emergencies');
    }
}
