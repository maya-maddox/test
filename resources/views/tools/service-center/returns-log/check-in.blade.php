@extends('tools.service-center.returns-log.layout', ["title" => "Check In"])

@section('page')
<div class="card my-4 col-12 p-0">
    <div class="card-body alert-secondary text-center">
        <form action="{{ route('tools.servicecenter.returnslog.checkin.store', $service_center->id) }}" method="POST">
            @csrf
            @include('components.forms.date-time-entry', ["id" => "recieved_date_localized", "label" => "Arrival Date (".(now()->shiftTimezone($service_center->timezone)->isoFormat('z')).")", "value" => now()->setTimezone($service_center->timezone), "required"])
            <input class="d-none" id="timezone" name="timezone" value="{{ now()->setTimezone($service_center->timezone)->timezone->getName() }}">
            @include('components.forms.text-entry', ["id" => "supportsync_reference", "label" => "Support Sync Reference"])
            @include('components.forms.text-entry', ["id" => "zendesk_reference", "label" => "Zendesk Reference"])
            @error("in_zendesk_table")
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            <div class="{{ $errors->has('in_zendesk_table') ? '' : 'd-none' }}">
                @include('components.forms.checkbox', ["id" => "override_warnings", "label" => "Override Zendesk Ticket ID Warning",
                    "value" => !$errors->has('in_zendesk_table')])
            </div>

            @include('components.forms.text-entry', ["id" => "other_reference", "label" => "Other Reference"])


            @include('components.forms.options-entry', ["id" => "return_reason", "label" => "Return Reason", "options" => $return_reason_options, "required"])

            @include('components.forms.options-entry', ["id" => "sku_id", "label" => "Returned SKU", "options" => $sku_options, "required"])

            @include('components.forms.options-entry', ["id" => "check_in_user_id", "label" => "Booked In By", "options" => $user_options, "value" => Auth::user()->id, "required"])


            @include('components.forms.text-area-entry', ["id" => "notes", "label" => "Notes"])

            <button type="submit" class="btn mx-2 btn-success" name="redirect-to" value="processing">Check-In & Start Processing Return</button>
            <button type="submit" class="btn mx-2 btn-success btn-lg">Check-In Return</button>
            <a class="btn mx-2 btn-danger" href="{{ route('tools.servicecenter.returnslog.index', $service_center->id) }}">Cancel Check-In</a>
        </form>
    </div>
</div>

@endsection