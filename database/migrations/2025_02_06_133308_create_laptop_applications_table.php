<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaptopApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laptop_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->unsignedBigInteger('course_id');
            $table->tinyInteger('approval_status')->default(0);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('laptop_applications');
    }
}
