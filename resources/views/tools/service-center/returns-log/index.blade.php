@extends('tools.service-center.returns-log.layout', ["title" => "Returns Log"])

@section('page')
<div class="card my-4 col-12 p-0">
    <div class="card-body alert-secondary text-center">
        <a href="{{ route('tools.servicecenter.returnslog.checkin.create', $service_center->id) }}" class="btn btn-info pb-0" role="button"><h2>Check-In New Return</h2></a>
    </div>
</div>

<div class="card my-4 col-4 offset-4 p-0">
    <div class="card-body p-0">
        <form action="{{ route('tools.servicecenter.returnslog.index', $service_center->id) }}" method="GET" class="m-2">
            @csrf

            @include('components.forms.text-entry', [
                "id" => "returns-search",
                "label" => "Search",
                "largeLabel" => true,
                "value" => $search_query
            ])
            <div class="col-12 text-center">
                <button class="btn btn-primary mx-auto">Search</button>
            </div>
        </form>
    </div>
</div>


@if($search_query || count($searched_returns ?? []))
<div class="card my-4 col-12 p-0">
    <div class="card-header text-center">
        <strong>Searched Returns</strong>
    </div>
    <div class="card-body p-0">
        @include('components.data-table', [
            "headers" => ["Check-In", "Test Date", "Completed Date", "Return #", "ZD #", "SS #", "Other Ref", "Reason", "SKU", "Details"],
            "keys" => ["recieved_date_localized", "tested_date_localized", "completed_date_localized", "internal_return_id", "zendesk_reference", "supportsync_reference", "other_reference", "return_reason_formatted", "sku_name", "button_raw"],
            "key_style" => ["button_raw" => "escaped", "recieved_date_localized" => "human_date", "tested_date_localized" => "human_date", "completed_date_localized" => "human_date"],
            "data" => $searched_returns ?? [],
            "name" => "Returns",
            "notResponsive" => true
        ])
    </div>
</div>
@endif

<div class="card my-4 col-12 p-0">
    <div class="card-header text-center">
        <strong>Checked In Returns</strong>
    </div>
    <div class="card-body p-0">
        @include('components.data-table', [
            "headers" => ["Check-In", "Return #", "ZD #", "Reason", "SKU", "Booker", "Processing"],
            "keys" => ["recieved_date_localized", "internal_return_id", "zendesk_reference", "return_reason_formatted", "sku_name", "checkInUser.name", "button_raw"],
            "key_style" => ["button_raw" => "escaped", "recieved_date_localized" => "human_date"],
            "data" => $checked_in_returns ?? [],
            "name" => "Returns",
            "notResponsive" => true
        ])
    </div>
</div>

<div class="card my-4 col-12 p-0">
    <div class="card-header text-center">
        <strong>In Process Returns</strong>
    </div>
    <div class="card-body p-0">
        @include('components.data-table', [
            "headers" => ["Check-In", "Testing Started", "Return #", "ZD #", "Reason", "SKU", "Technician", "Processing"],
            "keys" => ["recieved_date_localized", "tested_date_localized", "internal_return_id", "zendesk_reference", "return_reason_formatted", "sku_name", "technician.name", "button_raw"],
            "key_style" => ["button_raw" => "escaped", "recieved_date_localized" => "human_date", "tested_date_localized" => "human_date"],
            "data" => $in_process_returns ?? [],
            "name" => "Returns",
            "notResponsive" => true
        ])
    </div>
</div>

<div class="card my-4 col-12 p-0">
    <div class="card-header text-center">
        <strong>Recent Processed Returns</strong>
    </div>
    <div class="card-body p-0">
        @include('components.data-table', [
            "headers" => ["Check-In", "Test Date", "Completed Date", "Return #", "ZD #", "Reason", "SKU", "All Checks", "Refund", "Customer Aware", "Process"],
            "keys" => ["recieved_date_localized", "tested_date_localized", "completed_date_localized", "internal_return_id", "zendesk_reference", "return_reason_formatted", "sku_name", "all_checks", "refund_type_formatted", "customer_aware", "button_raw"],
            "key_style" => ["button_raw" => "escaped", "recieved_date_localized" => "human_date", "tested_date_localized" => "human_date", "completed_date_localized" => "human_date"],
            "data" => $recent_processed_returns ?? [],
            "name" => "Returns",
            "notResponsive" => true
        ])
    </div>
</div>

@if(config('servicecenter.returnslog.returns_log_upload_enabled'))
<div class="card">
    <div class="card-body">
        <form method="POST" action={{ route('tools.servicecenter.returnslog.file-upload', $service_center->id) }} enctype="multipart/form-data">
            @csrf
    
            @include('components.forms.file-upload', ["id" => "returns_log_file", "label" => "File", "accept" => ".csv"])
    
            <button type="submit" class="btn btn-warning">Dispatch job to Import Historic Returns Log</button>
        </form> 
    </div>
</div>
@endif
@endsection