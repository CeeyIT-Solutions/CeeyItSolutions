@extends($activeTemplate.'layouts.master')
@section('content')
<div class="container pt-50 pb-50">
    <div class="row justify-content-center mt-3">
        <div class="col-md-10">
            <div class="card custom--card">
                <div class="card-header px-4 py-3 bg-transparent">
                    <h6>{{$pageTitle}}</h6>
                </div>
                
                <div class="card-body px-4 py-3">
                    <form action="{{route('user.application.submit-form')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Highest Level of Education</label>
                                <select id="education-level" name="highest_education" class="form--control" name="" required>
                                    <option value="">Select your education level</option>
                                    <option value="no-formal-education">No Formal Education</option>
                                    <option value="primary-education">Primary Education (Elementary School)</option>
                                    <option value="secondary-education">Secondary Education (Middle School/Junior High)</option>
                                    <option value="high-school">High School Diploma or Equivalent</option>
                                    <option value="associates-degree">Associate’s Degree</option>
                                    <option value="bachelors-degree">Bachelor’s Degree</option>
                                    <option value="masters-degree">Master’s Degree</option>
                                    <option value="doctorate-degree">Doctorate or Professional Degree</option>
                                    <option value="vocational-certification">Vocational or Technical Certification</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Current Institution/Employment</label>
                                <input class="form--control" type="text" name="current_institution_employment" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Field of Study or Career Interest</label>
                                <input class="form--control" type="text" name="field_of_study_or_career_interest" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Course or Program Applying For</label>
                                <select name="program_course_id" class="form--control" required>
                                    <option value="">Select a course</option>
                                    @forelse ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Why Are You Interested in This Course</label>
                                <textarea class="form--control" type="text" name="course_interest_reason" required></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Why Do You Need Sponsorship</label>
                                <textarea class="form--control" type="text" name="sponsorship_reason" required></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>How Will This Course Impact Your Life or Career</label>
                                <textarea class="form--control" type="text" name="impact_of_course" required></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>How Will You Give Back? (e.g., volunteering or awareness)</label>
                                <textarea class="form--control" type="text" name="give_back_plan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Social Media Handle</label>
                                <input class="form--control" type="text" name="social_media_handle" required />
                            </div>
                            <div class="form-group">
                                <label>How Did you her about CeeyIT</label>
                                <select id="programCourse" name="heard_about_platform" class="form--control" onchange="toggleAdditionalField()" required>
                                    <option value="">Select an option</option>
                                    <option value="Social media">Social media</option>
                                    <option value="Words of mouth">Words of mouth</option>
                                    <option value="Referral">Referral</option>
                                </select>
                            </div>

                            <div id="additionalField" class="form-group" style="display: none;">
                                <label id="additionalFieldLabel"></label>
                                <input type="text" id="additionalFieldInput" class="form--control" placeholder="" name="heard_about_reference" />
                            </div>

                            <div class="form-group">
                                <input type="checkbox" id="attendanceCommitment" name="attendance_commitment" value="1" required>
                                <label for="attendanceCommitment">I commit to attending all required sessions.</label>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" id="termsAndConditions" name="terms_and_conditions" required>
                                <label for="termsAndConditions">
                                    I agree to the <a href="terms-and-conditions.html" target="_blank">Terms and Conditions</a>.
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleAdditionalField() {
        const programCourse = document.getElementById("programCourse").value;
        const additionalField = document.getElementById("additionalField");
        const additionalFieldLabel = document.getElementById("additionalFieldLabel");
        const additionalFieldInput = document.getElementById("additionalFieldInput");

        if (programCourse === "Social media") {
            additionalField.style.display = "block";
            additionalFieldLabel.textContent = "Which Social Media Platform?";
            additionalFieldInput.placeholder = "Enter the social media platform";
            additionalFieldInput.value = ""; // Clear any previous input
        } else if (programCourse === "Referral") {
            additionalField.style.display = "block";
            additionalFieldLabel.textContent = "Who Referred You?";
            additionalFieldInput.placeholder = "Enter the name of the person";
            additionalFieldInput.value = ""; // Clear any previous input
        } else {
            additionalField.style.display = "none";
            additionalFieldInput.value = ""; // Clear the input if hidden
        }
    }
</script>
@endsection