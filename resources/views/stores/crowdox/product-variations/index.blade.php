@extends('stores.crowdox.product-variations.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.productvariations.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Product Variations</button>
    </form>

</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "SKU", "Project", "Product"],
    "data" => $crowdox_product_variations,
    "keys" => ["crowd_ox_id", "SKU", "crowd_ox_project_id", "crowd_ox_product_id"],
    "routes" => ["route" => "stores.crowdox.productvariations"],
    "name" => "CrowdOx Products"
])



@endsection
