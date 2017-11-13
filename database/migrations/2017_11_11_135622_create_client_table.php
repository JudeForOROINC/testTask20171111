<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('firstname_id')->nullable()->unsigned()->index();
            $table->integer('lastname_id')->nullable()->unsigned()->index();
            $table->string('personal_code')->nullable();
            $table->string('email')->unique();
            $table->string('adress')->nullable();
            $table->integer('city_id')->nullable()->unsigned()->index();
            $table->integer('country_id')->nullable()->unsigned()->index();
            $table->timestamps();
            $table->foreign('firstname_id')->references('id')->on('firstname_ref')->onDelete('set null');
            $table->foreign('lastname_id')->references('id')->on('lastname_ref')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('city_ref')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('country_ref')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
