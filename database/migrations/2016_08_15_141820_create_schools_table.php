<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');

            $table->string('brin')->nullable();
            $table->string('naam')->nullable();
            $table->string('adres')->nullable();
            $table->string('postcode')->nullable();
            $table->string('plaatsnaam')->nullable();
            $table->string('bevoegd_gezag')->nullable();
            $table->string('website')->nullable();

            $table->integer('aanbod_1')->nullable();
            $table->integer('aanbod_2')->nullable();
            $table->integer('aanbod_3')->nullable();
            $table->integer('aanbod_4')->nullable();
            $table->integer('aanbod_5')->nullable();

            $table->integer('vraag_1')->nullable();
            $table->integer('vraag_2')->nullable();
            $table->integer('vraag_3')->nullable();
            $table->integer('vraag_4')->nullable();
            $table->integer('vraag_5')->nullable();

            $table->string('rd_x')->nullable();
            $table->string('rd_y')->nullable();

            $table->string('wgs84_x')->nullable();
            $table->string('wgs84_y')->nullable();

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
        Schema::drop('schools');
    }
}
