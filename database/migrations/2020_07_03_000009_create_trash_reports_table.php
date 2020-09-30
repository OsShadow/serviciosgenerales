<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrashreportsTable extends Migration
{
   

    /**
     * Run the migrations.
     * @table trashreports
     *
     */
    
    public function up()
    {
        Schema::create('trash_reports', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->date('date');
            $table->decimal('quantity');
            $table->unsignedBigInteger('area_report');
            $table->unsignedBigInteger('user_report');
            $table->enum('type',array('Sanitario','General'));
            $table->timestamps();

            $table->foreign('user_report')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('area_report')
            ->references('id')
            ->on('areas')
            ->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     */

     public function down()
     {
       Schema::dropIfExists('trash_reports');
     }
}
