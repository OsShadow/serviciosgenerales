<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_travel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_car');
            
            $table->date('date_start');
            $table->time('hour_start');

            $table->date('date_end')->nullable();
            $table->time('hour_end')->nullable();

            $table->text('driver');

            $table->decimal('km_start');
            $table->decimal('km_end')->nullable();

            $table->decimal('gas_recharge')->nullable();
            $table->longText('observations')->nullable();
            
            $table->boolean('finished');
            $table->timestamps();

            $table->foreign('id_user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('id_car')
            ->references('id')
            ->on('vehicles')
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
        Schema::dropIfExists('vehicles_travel');
    }
}
