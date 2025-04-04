<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');

            // Education level
            $table->string('highest_education', 255)->nullable();
            $table->longText('current_institution_employment')->nullable();
            $table->longText('field_of_study_or_career_interest')->nullable();

            // Program Selection
            $table->unsignedInteger('program_course_id');
            $table->longText('course_interest_reason')->nullable();

            // Scholarship Request & Motivation
            $table->longText('sponsorship_reason')->nullable();
            $table->longText('impact_of_course')->nullable();

            // Social Media
            $table->longText('social_media_handle')->nullable();

            // How Did You Hear About CeeyIT?
            $table->longText('heard_about_platform')->nullable();
            $table->longText('heard_about_reference')->nullable();

            // Commitment & Contribution
            $table->longText('give_back_plan')->nullable();
            $table->boolean('attendance_commitment')->default(false);

            $table->string('status')->default('pending');
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
        Schema::dropIfExists('skill_applications');
    }
}
