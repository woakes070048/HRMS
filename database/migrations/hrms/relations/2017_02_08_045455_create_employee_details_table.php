<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('blood_group_id')->unsigned();
            $table->bigInteger('national_id');
            $table->bigInteger('passport_no');
            $table->bigInteger('tin_no');
            $table->string('father_name',50);
            $table->string('mother_name',50);
            $table->string('personal_email',100);
            $table->string('official_email',100);
            $table->date('birth_day');
            $table->date('joining_date');
            $table->string('phone_number',20);
            $table->enum('gender',['male','female']);
            $table->string('marital_status',10);
            $table->string('religion',50);
            $table->string('nationality',50);
            $table->string('emergency_contact_person',100);
            $table->text('emergency_contact_address');
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('blood_group_id')->references('id')->on('blood_groups')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_details',function(Blueprint $table){
            $table->dropForeign('employee_details_user_id_foreign');
            $table->dropForeign('employee_details_blood_group_id_foreign');
        });
        Schema::dropIfExists('employee_details');
    }
}
