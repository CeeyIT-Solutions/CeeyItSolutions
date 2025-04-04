<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // Education Level
            'highest_education' => 'nullable|string|max:255',
            'current_institution_employment' => 'nullable|string|max:255',
            'field_of_study_or_career_interest' => 'nullable|string|max:255',

            // Program Selection
            'program_course_id' => 'required|integer|exists:courses,id',

            'course_interest_reason' => 'nullable|string|max:1000',

            // Scholarship Request & Motivation
            'sponsorship_reason' => 'nullable|string|max:1000',
            'impact_of_course' => 'nullable|string|max:1000',

            // Social Media
            'social_media_handle' => 'nullable|string|max:255|regex:/^@?([a-zA-Z0-9_]){1,15}$/',

            // How Did You Hear About CeeyIT?
            'heard_about_platform' => 'nullable|string|max:255',
            'heard_about_reference' => 'nullable|string|max:255',

            // Commitment & Contribution
            'give_back_plan' => 'nullable|string|max:1000',
            'attendance_commitment' => 'required|boolean',

        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'program_course_id.required' => 'Please select a program course.',
            'program_course_id.exists' => 'The selected program course is invalid.',
            'attendance_commitment.required' => 'You must commit to attendance.',
            'social_media_handle.regex' => 'The social media handle must be in a valid format.'
            // Add more custom messages as needed
        ];
    }
}
