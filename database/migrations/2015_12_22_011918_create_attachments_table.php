<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attachable_id')->unsigned()->index();
            $table->string('attachable_type')->index();
            $table->string('name');
            $table->string('extension')->nullable();
            $table->string('path');
            $table->tinyInteger('thumbnail')->default(0);
            $table->string('thumbnail_path')->nullable();
            $table->integer('width')->default(0);
            $table->integer('height')->default(0);
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('attachment_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attachment_id')->unsigned()->index();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->string('description')->nullable();

            $table->unique(['attachment_id','locale']);
            $table->foreign('attachment_id')->references('id')->on('attachments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attachment_translations');
        Schema::drop('attachments');
    }
}
