<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');            
            $table->string('employee_no');
            $table->integer('designation_id')->unsigned();   
            $table->string('first_name', 45);            
            $table->string('middle_name', 45)->nullable();  
            $table->string('last_name', 45);            
            $table->string('nick_name', 45)->nullable();            
            $table->string('email', 45)->unique();            
            $table->string('password');            
            $table->rememberToken();           
            $table->boolean('status')->default(1)->comment='0=inactive, 1=active'; 
            $table->string('mobile_number',16); 
            $table->string('photo',200)->nullable();  
            $table->integer('created_by')->default(0);    
            $table->integer('updated_by')->default(0);
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
        Schema::dropIfExists('users');
    }
}
