<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitTable extends Migration
{
    
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit_name',100);
            $table->integer('unit_parent_id')->unsigned();
            $table->integer('departments_id')->unsigned();
            $table->string('unit_details',500);
            $table->boolean('unit_status')->default(1)->comment='1=active, 0=inactive';
            $table->timestamps();
            
            $table->foreign('departments_id')->references('id')->on('departments')->onDelete('restrict');
        });
    }

    
    public function down()
    {
        Schema::table('units',function (Blueprint $table){
            $table->dropForeign('units_departments_id_foreign');
        });
        Schema::dropIfExists('units');
    }
}
