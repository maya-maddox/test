@extends('stores.crowdox.orders.layout', ["title" => "Show"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.orders.orderlines.import', $crowdox_order) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Order Lines</button>
    </form>
    <form action="{{ route('stores.crowdox.orders.orderselections.import', $crowdox_order) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Order Selections</button>
    </form>
    <form action="{{ route('stores.crowdox.orders.clean', $crowdox_order) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Clean order related models</button>
    </form>
    <form action="{{ route('stores.crowdox.orders.link', $crowdox_order) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Link order to non-crowdox models</button>
    </form>

</div>

<div class="card col-md-8 offset-md-2 my-3">
    <div class="card-header">Export</div>
    <div class="card-body">
        <pre>
        {!! nl2br(json_encode($export, JSON_PRETTY_PRINT))!!}
        </pre>
    </div>
</div>


<div class="card col-md-8 offset-md-2">
    <div class="card-header">Raw Data</div>
    <div class="card-body">
        <pre>
        {!! nl2br(json_encode(json_decode($crowdox_order->raw_data), JSON_PRETTY_PRINT))!!}
        </pre>
    </div>
</div>



@endsection
