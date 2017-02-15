<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicSalaryInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_salary_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45); 
            $table->float('amount', 9, 2);
            $table->boolean('amount_status')->default(0)->comment='0=percent, 1=amount-tk';
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
        Schema::dropIfExists('basic_salary_info');
    }
}
