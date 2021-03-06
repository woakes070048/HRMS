<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekends', function (Blueprint $table) {
            $table->increments('id');
            $table->string('weekend', 200);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->boolean('status')->default(1)->comment='0=inactive, 1=active';
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
        Schema::dropIfExists('weekends');
    }
}
