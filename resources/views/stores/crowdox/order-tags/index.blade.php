@extends('stores.crowdox.order-tags.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.ordertags.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Order Tags</button>
    </form>

</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Name"],
    "data" => $crowdox_order_tags,
    "keys" => ["crowd_ox_id", "name",],
    "routes" => ["route" => "stores.crowdox.ordertags"],
    "name" => "CrowdOx Order Tags"
])



@endsection
