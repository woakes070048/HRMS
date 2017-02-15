<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDependOnRelationTable extends Migration
{
    
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('company_name',45);
            $table->text('company_address');
            $table->string('database_name',45)->unique();
            $table->date('package_end_date');
            $table->tinyInteger('config_status')->default('1')->comment="1=company active,0=company inactive";
            $table->integer('parent_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::create('user_emails', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('config_id')->unsigned();
            $table->string('email',75)->unique();
            $table->timestamps();

            $table->foreign('config_id')->references('id')->on('configs')->onDelete('restrict');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package_name',150);
            $table->text('package_details');
            $table->double('package_price',9,2);
            $table->integer('package_duration');
            $table->tinyInteger('package_type');
            $table->tinyInteger('package_sister_concern_limit');
            $table->tinyInteger('package_level_limit');
            $table->smallInteger('package_user_limit');
            $table->tinyInteger('package_status');
            $table->integer('package_created_by')->default(0);
            $table->timestamps();

            // $table->foreign('package_created_by')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('config_id')->unsigned();
            $table->integer('package_id')->unsigned();
            $table->double('payment_amount', 11, 2);
            $table->smallInteger('payment_duration');
            $table->tinyInteger('payment_status')->default('1')->comment="1=active,0=inactive";
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('restrict');
            $table->foreign('config_id')->references('id')->on('configs')->onDelete('restrict');
        });

        

        Schema::create('module_package_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->unsigned()->nullable();
            $table->integer('package_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules')->onDelete('restrict');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('restrict');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('module_package_maps');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('user_emails');
        Schema::dropIfExists('configs');
    }
}
