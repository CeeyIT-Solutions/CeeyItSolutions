{{-- info modal --}}
<div class="modal fade" id="info-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg--base">
              <h5 class="modal-title">@lang('More Info.')</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Course Level')</span>
                        <span class="level"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Discount')</span>
                        <span class="discount"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Total Chapter')</span>
                        <span class="chapter"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('Total Lectures')</span>
                        <span class="lecture"></span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn--secondary btn-sm" data-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
  </div>


{{-- ban modal --}}
<div class="modal fade" id="banModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-exclamation-circle text-danger display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are sure to ban this course ? Please tell some reasons to author.')</h6>

                    <textarea name="reasons"placeholder="Write your reasons" required></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--danger del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Un ban modal --}}
<div class="modal fade" id="unbanModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-check-circle  text--success display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are sure to Un-ban this course ?')</h6>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--success del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- reject modal --}}
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-exclamation-circle text-danger display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are sure to reject this course ? Please tell some reasons to author.')</h6>

                    <textarea name="reasons"placeholder="Write your reasons" required></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--danger del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- approve modal --}}
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-check-circle  text--success display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are sure to approve this course ?')</h6>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--success del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- approve user course modal --}}
<div class="modal fade" id="approveCourseUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-check-circle  text--success display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are you sure you want to approve this user to the course?')</h6>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--success del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- reject user course modal --}}
<div class="modal fade" id="rejectCourseUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-exclamation-circle text-danger display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are you sure you want to reject this user to the course? Please tell some reasons to user.')</h6>

                    <textarea name="reasons"placeholder="Write your reasons" required></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--danger del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>



{{--remove top course modal --}}
<div class="modal fade" id="removeTopModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-exclamation-circle text--danger display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are sure to remove from top course?')</h6>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--danger del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- approve top course modal --}}
<div class="modal fade" id="approveTopModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
            <form action="" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <i class="las la-check-circle  text--success display-2"></i>
                    <h6 class="text--secondary mb-15">@lang('Are sure to marked as top course ?')</h6>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"  class="btn btn--success del">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>