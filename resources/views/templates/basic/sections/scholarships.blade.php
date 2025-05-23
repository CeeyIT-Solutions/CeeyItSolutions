@php
    use App\Models\Course;
@endphp

{{-- <section class="pt-100 pb-100 mb-5 mt-5">
    <div class="d-flex justify-content-center align-items-center" style="height: calc(100vh - 200px);">
        <div class="card shadow-lg p-4"
            style="max-width: 800px; width: 100%; height: 500px; display: flex; justify-content: center; align-items: center;">
            <h1 class="text-center mt-2">Applications Closed</h1>
            <p class="mt-4 text-center">New Applications will commerce on May 21st 2025!</p>
            <div class="d-flex justify-content-center align-items-center">
                <a href="/" class="btn btn-register">Back to Homepage</a>
            </div>
        </div>
    </div>
</section> --}}

<section class="pt-100 pb-100 mb-5 mt-5">
    <div class="d-flex justify-content-center">
        <div class="card shadow-lg p-4" style="max-width: 800px; width: 100%;">
            <form action="{{ route('scholarship.apply') }}" method="POST">
                @csrf

                <h3 class="mb-4">Personal Information</h3>
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                        value="{{ old('full_name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                        required>
                </div>

                <h3 class="mb-4">Application Details</h3>
                <div class="mb-3">
                    <label for="occupation" class="form-label">Current Occupation</label>
                    <select class="form-select" id="occupation" name="occupation" required>
                        <option value="" disabled {{ old('occupation') ? '' : 'selected' }}>Select Occupation
                        </option>
                        <option value="it_professional" {{ old('occupation') === 'it_professional' ? 'selected' : '' }}>
                            IT
                            Professional</option>
                        <option value="non_it_professional"
                            {{ old('occupation') === 'non_it_professional' ? 'selected' : '' }}>Non-IT
                            Professional</option>
                        <option value="other" {{ old('occupation') === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="interest" class="form-label">Why are you interested in this course?</label>
                    <textarea class="form-control" id="interest" name="interest" rows="3" required>{{ old('interest') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="challenges" class="form-label">What challenges have you faced in transitioning to
                        tech?</label>
                    <textarea class="form-control" id="challenges" name="challenges" rows="3" required>{{ old('challenges') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Which course are you applying for?</label>
                    @php
                        $categories = Course::active()
                            ->whereDate('created_at', '>', '2025-02-10')
                            ->orderBy('title', 'ASC')
                            ->pluck('title', 'id');
                        // $categories = Course::active()->orderBy('title', 'ASC')->pluck('title', 'id');
                    @endphp
                    <select class="form-select" id="course" name="course_id" required>
                        <option value="" disabled {{ old('course_id') ? '' : 'selected' }}>Select a course
                        </option>
                        @foreach ($categories as $id => $title)
                            <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>
                                {{ $title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tech_experience" class="form-label">Do you have prior tech experience?</label>
                    <select class="form-select" id="tech_experience" name="tech_experience" required>
                        <option value="" disabled {{ old('tech_experience') ? '' : 'selected' }}>Select an option
                        </option>
                        <option value="Yes" {{ old('tech_experience') === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('tech_experience') === 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div id="tech_experience_details" class="mb-3 {{ old('tech_experience') === 'Yes' ? '' : 'd-none' }}">
                    <label for="tech_experience_details_input" class="form-label">If yes, provide additional
                        details.</label>
                    <textarea class="form-control" id="tech_experience_details_input" name="tech_experience_details" rows="3">{{ old('tech_experience_details') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="goals" class="form-label">How will this scholarship help you achieve your
                        goals?</label>
                    <textarea class="form-control" id="goals" name="goals" rows="3" required>{{ old('goals') }}</textarea>
                </div>

                <h3 class="mb-4">Agreement</h3>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms" name="terms"
                        {{ old('terms') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="terms">I accept the terms and conditions.</label>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-5">Submit Application</button>
                </div>

            </form>

        </div>

    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const techExperienceSelect = document.getElementById('tech_experience');
        const techExperienceDetails = document.getElementById('tech_experience_details_input');

        techExperienceSelect.addEventListener('change', function() {
            if (this.value === 'Yes') {
                techExperienceDetails.parentElement.classList.remove('d-none');
                techExperienceDetails.setAttribute('required', 'true');
            } else {
                techExperienceDetails.parentElement.classList.add('d-none');
                techExperienceDetails.removeAttribute('required');
            }
        });
    });
</script>
