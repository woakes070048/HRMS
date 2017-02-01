<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package_name',150);
            $table->text('package_details');
            $table->double('package_price',9,2);
            $table->integer('package_duration');
            $table->tinyInteger('package_type');
            $table->tinyInteger('package_level_limit');
            $table->smallInteger('package_user_limit');
            $table->tinyInteger('package_status');
            $table->integer('package_created_by')->unsigned();
            $table->timestamps();

            $table->foreign('package_created_by')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
