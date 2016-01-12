<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('recommended')->default(0);
            $table->string('name');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();
        });

        Schema::create('place_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->unsigned()->index();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->string('excerpt')->nullable();
            $table->text('description');
            $table->string('street');
            $table->string('subdistrict');
            $table->string('district');
            $table->string('province');
            $table->string('postcode', 10);

            $table->unique(['place_id','locale']);
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('place_translations');
        Schema::drop('places');
    }
}
