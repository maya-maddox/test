@extends('stores.crowdox.order-selections.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.orderselections.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Order Selections</button>
    </form>
    <form action="{{ route('stores.crowdox.orderselections.import.dispatch') }}" method="post">
        @csrf
        Page to start fetching:
        <input type="number" name="page_start" id="page_start" value="1">
        <button type="submit" class="btn btn-warning">Dispatch CrowdOx Order Selections Importer Job</button>
    </form>

</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Project", "Order", "Product", "ProductVariation"],
    "data" => $crowdox_order_selections,
    "keys" => ["crowd_ox_id", "crowd_ox_project_id", "crowd_ox_order_id", "crowd_ox_product_id", "crowd_ox_product_variation_id"],
    "routes" => ["route" => "stores.crowdox.orderselections"],
    "name" => "CrowdOx Order Selections"
])



@endsection
