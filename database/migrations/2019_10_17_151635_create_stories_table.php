<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('original');
            $table->integer('public_status')->default(config('Custom.statusPublic')); //public or draft
            $table->string('img');
            $table->integer('use_status');   //vip or normal
            $table->integer('view_count')->default('0');   // number of view this story
            $table->integer('total_vote')->default('0');   //total vote.
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
        Schema::dropIfExists('stories');
    }
}
