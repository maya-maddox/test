@extends('stores.crowdox.customers.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.customers.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Customers</button>
    </form>
    <form action="{{ route('stores.crowdox.customers.import.dispatch') }}" method="post">
        @csrf
        Page to start fetching:
        <input type="number" name="page_start" id="page_start" value="1">
        <button type="submit" class="btn btn-warning">Dispatch CrowdOx Customers Importer Job</button>
    </form>
</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Name", "Email"],
    "data" => $crowdox_customers,
    "keys" => ["crowd_ox_id", "name", "email"],
    "routes" => ["route" => "stores.crowdox.customers"],
    "name" => "CrowdOx Customers"
])



@endsection
