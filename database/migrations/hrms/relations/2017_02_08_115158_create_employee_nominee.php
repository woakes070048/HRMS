<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeNominee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_nominee', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nominee_name',20);
            $table->string('nominee_relation',20);
            $table->text('nominee_address');
            $table->date('nominee_birth_date',20);
            $table->string('nominee_distribution');
            $table->string('nominee_rest_distribution');
            $table->string('nominee_photo');
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_nominee',function (Blueprint $table){
            $table->dropForeign('employee_nominee_user_id_foreign');
        });
        Schema::dropIfExists('employee_nominee');
    }
}
