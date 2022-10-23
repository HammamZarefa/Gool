<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('league_key')->nullable(false);
            $table->integer('country_key')->nullable(false);
            $table->string('home_logo')->nullable(true);
            $table->string('away_logo')->nullable(true);
            $table->integer('event_key');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('home_team');
            $table->string('away_team');
            $table->string('event_half_time_result')->nullable(true);
            $table->string('event_final_result')->nullable(true);
            $table->string('status')->nullable(true);
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
        Schema::dropIfExists('matches');
    }
}
