<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterReportsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'water_reports';

    /**
     * Run the migrations.
     * @table water_reports
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_reports', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('hour');
            $table->decimal('read');
            $table->decimal('cloration');
            $table->longText('Observations')->nullable();
            $table->timestamps();


        });

        Schema::create('water_reports_general', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_date_start');
            $table->unsignedBigInteger('id_date_end');

            $table->foreign('id_date_start')
            ->references('id')
            ->on('water_reports')
            ->onDelete('cascade');

            $table->foreign('id_date_end')
            ->references('id')
            ->on('water_reports')
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
       Schema::dropIfExists('water_reports');
     }
}
