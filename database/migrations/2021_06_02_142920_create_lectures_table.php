<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('lectures')) {
            Schema::create('lectures', function (Blueprint $table) {
                $table->id();
                $table->integer('course_id');
                $table->integer('chapter_id');
                $table->string('title');
                $table->string('slug');
                $table->text('description');
                $table->integer('type')->comment('1 => uploaded, 2 => url, 3 => file');
                $table->string('url')->nullable();
                $table->string('video_file')->nullable();
                $table->string('file')->nullable();
                $table->string('visibility')->nullable();
                $table->string('status')->comment('1 => active, 0 => inactive');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectures');
    }
}
