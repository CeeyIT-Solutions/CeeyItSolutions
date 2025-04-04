<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('occupation')->nullable();
            $table->text('interest')->nullable();
            $table->text('challenges')->nullable();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('tech_experience');
            $table->text('tech_experience_details')->nullable();
            $table->text('goals')->nullable();
            $table->boolean('terms')->default(true);
            $table->string('slack_invite_status')->nullable()->default('pending');
            $table->tinyInteger('approval_status')->default(0); // 0: Pending, 1: Approved, 2: Rejected
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
        Schema::dropIfExists('scholarship_applications');
    }
}
