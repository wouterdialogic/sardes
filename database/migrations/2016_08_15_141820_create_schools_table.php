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

            $table->integer('score_1')->nullable();
            $table->integer('score_2')->nullable();
            $table->integer('score_3')->nullable();
            $table->integer('score_4')->nullable();
            $table->integer('score_5')->nullable();
            $table->integer('binaire_score_1')->nullable();
            $table->integer('binaire_score_2')->nullable();
            $table->integer('binaire_score_3')->nullable();
            $table->integer('binaire_score_4')->nullable();
            $table->integer('binaire_score_5')->nullable();

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
