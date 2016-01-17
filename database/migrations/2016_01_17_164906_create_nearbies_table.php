<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNearbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nearbies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->unsigned()->index();
            $table->string('tel')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();

            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });

        Schema::create('nearby_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nearby_id')->unsigned()->index();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->string('description')->nullable();

            $table->unique(['nearby_id','locale']);
            $table->foreign('nearby_id')->references('id')->on('nearbies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nearby_translations');
        Schema::drop('nearbies');
    }
}
