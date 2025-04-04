@php
  use App\Models\Course;
@endphp

<section class="pt-100 pb-100 mb-5 mt-5">
  <div class="d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="max-width: 800px; width: 100%;">
      <form action="{{ route('laptop.apply') }}" method="POST">
        @csrf

        <h3 class="mb-4 text-center">Apply for a Laptop</h3>
        <div class="mb-3">
          <label for="full_name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}"
            required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>

        <div class="mb-3">
          <label for="course" class="form-label">Course</label>
          @php
      $categories = Course::active()
        ->orderBy('title', 'ASC')
        ->pluck('title', 'id');
    @endphp
          <select class="form-select" id="course" name="course_id" required>
            <option value="" disabled {{ old('course_id') ? '' : 'selected' }}>Select a course</option>
            @foreach ($categories as $id => $title)
        <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
      @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Tell us the reason ? </label>
          <textarea class="form-control" id="reason" style="resize: none !important;box-shadow:none" name="reason"
            rows="5">{{ old('reason') }}</textarea>
        </div>

        <div class="mt-4 text-center">
          <button type="submit" class="btn btn-signup px-5" style="width:180px;line-height:10px;height:40px;">Apply Now</button>
        </div>
      </form>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>