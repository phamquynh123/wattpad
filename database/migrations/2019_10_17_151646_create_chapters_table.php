<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('story_id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->longText('content');
            $table->integer('public_status')->default(config('Custom.statusPublic')); //public or draft
            $table->integer('language_id')->default(config('Custom.viId'));
            $table->bigInteger('parent_language_id')->default('0'); // story parent id
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
        Schema::dropIfExists('chapters');
    }
}
