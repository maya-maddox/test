@extends('stores.crowdox.order-addresses.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.orderaddresses.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Order Addresses</button>
    </form>
    <form action="{{ route('stores.crowdox.orderaddresses.import.dispatch') }}" method="post">
        @csrf
        Page to start fetching:
        <input type="number" name="page_start" id="page_start" value="1">
        <button type="submit" class="btn btn-warning">Dispatch CrowdOx Order Addresses Importer Job</button>
    </form>

</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Project", "Order", "Country", "Name", "Address 1", "Address 2", "City", "Phone"],
    "data" => $crowdox_order_addresses,
    "keys" => ["crowd_ox_id", "crowd_ox_project_id", "crowd_ox_order_id", "crowd_ox_country_id", "name", "address_1", "address_2", "city", "phone_number"],
    "routes" => ["route" => "stores.crowdox.orderaddresses"],
    "name" => "CrowdOx Order Addresses"
])



@endsection
