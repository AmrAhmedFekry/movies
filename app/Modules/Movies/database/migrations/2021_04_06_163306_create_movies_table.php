<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('original_id');
            $table->loggers();


			$table->string('original_language')->nullable();;
			$table->string('original_title')->nullable();;
			$table->string('backdrop_path')->nullable();;
			$table->text('overview')->nullable();;
			$table->string('release_date')->nullable();;
			$table->string('title')->nullable();;
			$table->integer('vote_count')->nullable();;
			$table->boolean('adult')->nullable();;
			$table->boolean('video')->nullable();;
			$table->float('popularity')->nullable();;
			$table->float('vote_average')->nullable();;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
