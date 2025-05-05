<div class="row align-items-center mb-30 justify-content-between">
    <div class="col-lg-6 col-sm-6">
        <h6 class="page-title">{{ __($pageTitle) }}</h6>
        @if ($pageTitle == 'Email Unverified Users')
            <button id="sendVerificationEmail1" type="button"
                class="btn btn--success ml-2 mr-2 mb-2">@lang('Send
                                                            Verification emails')</button>
        @endif
    </div>

    <div class="col-lg-6 col-sm-6 text-sm-right mt-sm-0 mt-3 right-part">
        @stack('breadcrumb-plugins')
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $('#sendVerificationEmail1').on('click', function() {
                var btn = $(this);
                btn.prop('disabled', true);
                btn.html('<i class="fa fa-spinner fa-spin"></i> Sending...');
                $.ajax({
                    url: '/admin/users/unverified/send-email',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        btn.prop('disabled', false);
                        btn.html('Send Verification emails');
                        if (response.success) {
                            notify('success', response.success);
                        } else {
                            notify('error', response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false);
                        btn.html('Send Verification emails');
                        notify('error', 'An error occurred. Please try again later.');
                    }
                });
            });
        });
    </script>
@endpush
