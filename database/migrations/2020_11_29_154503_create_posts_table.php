<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->default('');
            $table->text('description');

            $table->enum('state', ['unreleased', 'uncracked', 'cracked', 'freeDRM'])->default('unreleased');
            $table->date('release_date');
            $table->date('crack_date')->nullable();

            $table->unsignedBigInteger('game_studio_id')->nullable();
//            $table->foreign('game_studio_id')->references('id')->on('game_studios')->onDelete('set null');
            $table->string('game_studio_name');

            $table->text('image');
            $table->text('header');
            $table->text('back_image');
            $table->text('video_link');
            $table->text('screen_shots')->default('["","","",""]');

            $table->text('system')->default('{"min":{"os":"none","cpu":"none","ram":"none","gpu":"none","hdd":"none"},"rec":{"os":"none","cpu":"none","ram":"none","gpu":"none","hdd":"none"}}');
            $table->string('prices')->default('{"epic":{"price":"0","url":""},"steam":{"price":"0","url":""}}');

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
        Schema::dropIfExists('posts');
    }
}
