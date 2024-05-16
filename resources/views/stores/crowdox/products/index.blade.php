@extends('stores.crowdox.products.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.products.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Products</button>
    </form>

</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Name", "Project", "Type"],
    "data" => $crowdox_products,
    "keys" => ["crowd_ox_id", "name", "crowd_ox_project_id", "type"],
    "routes" => ["route" => "stores.crowdox.products"],
    "name" => "CrowdOx Products"
])



@endsection
