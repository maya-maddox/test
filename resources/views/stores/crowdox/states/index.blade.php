@extends('stores.crowdox.states.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.states.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx States</button>
    </form>

</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Name"],
    "data" => $crowdox_states,
    "keys" => ["crowd_ox_id", "name"],
    "routes" => ["route" => "stores.crowdox.states"],
    "name" => "CrowdOx States"
])



@endsection
