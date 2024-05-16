@extends('stores.crowdox.orders.layout', ["title" => "Index"])

@section('page')

<div class="card">
    <form action="{{ route('stores.crowdox.orders.import') }}" method="post">
        @csrf
        Order ID to import (blank for all)
        <input type="number" name="crowd_ox_order_id" id="crowd_ox_order_id"/>
        <button type="submit" class="btn btn-warning">Import CrowdOx Orders</button>
    </form>
    <form action="{{ route('stores.crowdox.orders.import.relations') }}" method="post">
        @csrf
        Order ID to import with Relations (blank for all)
        <input type="number" name="crowd_ox_order_id" id="crowd_ox_order_id"/>
        <button type="submit" class="btn btn-warning">Import CrowdOx Orders with Relations</button>
    </form>
    <form action="{{ route('stores.crowdox.orders.import.dispatch') }}" method="post">
        @csrf
        Page to start fetching:
        <input type="number" name="page_start" id="page_start" value="1">
        <button type="submit" class="btn btn-warning">Dispatch CrowdOx Orders Importer Job</button>
    </form>

    <a class="btn btn-primary" href="{{ route('stores.crowdox.orders.download') }}">Download .csv </a>
</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Name", "Tags", "Email"],
    "data" => $crowdox_orders,
    "keys" => ["crowd_ox_id", "name", "crowdOxOrderTags", "crowdOxCustomer.email"],
    "key_style" => ["crowdOxOrderTags" => "array.name"],
    "routes" => ["route" => "stores.crowdox.orders", "show"],
    "name" => "CrowdOx Orders",
])



@endsection
