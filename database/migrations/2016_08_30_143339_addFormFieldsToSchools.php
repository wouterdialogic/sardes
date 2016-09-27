<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormFieldsToSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function($table) {
            $table->integer('meta_score_leerlingen')->nullable();
            $table->integer('meta_score_onderwijs')->nullable();
            $table->integer('meta_score_voorzieningen')->nullable();
            $table->integer('meta_score_afspraken')->nullable();
            $table->integer('meta_score_samenwerken')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function($table) {
            $table->dropColumn('meta_score_leerlingen');
            $table->dropColumn('meta_score_onderwijs');
            $table->dropColumn('meta_score_voorzieningen');
            $table->dropColumn('meta_score_afspraken');
            $table->dropColumn('meta_score_samenwerken');
        });
    }
}
