<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->integer('author_id');
                $table->integer('category_id');
                $table->integer('subcategory_id');
                $table->string('title');
                $table->string('thumbnail');
                $table->text('description');
                $table->text('will_learn');
                $table->integer('level_id');
                $table->text('tags');
                $table->decimal('price',18,8);
                $table->integer('discount');
                $table->integer('is_top');
                $table->integer('status')->comment('0 => inactive, 1 => active');
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
        Schema::dropIfExists('courses');
    }
}
