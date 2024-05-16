@extends('stores.crowdox.order-transactions.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.ordertransactions.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Order Transactions</button>
    </form>
</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Project", "Order", "Amount", "Shipping", "Currency", "Confirmed", "Paid At"],
    "data" => $crowdox_order_transactions,
    "keys" => ["crowd_ox_id", "crowd_ox_project_id", "crowd_ox_order_id", "amount_cents", "shipping_amount_cents", "currency", "confirmed", "paid_at"],
    "routes" => ["route" => "stores.crowdox.ordertransactions"],
    "name" => "CrowdOx Order Transactions"
])



@endsection
