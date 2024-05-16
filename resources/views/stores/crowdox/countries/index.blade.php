@extends('stores.crowdox.countries.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.countries.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Countries</button>
    </form>

</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Name", "ISO2"],
    "data" => $crowdox_countries,
    "keys" => ["crowd_ox_id", "name", "iso2"],
    "routes" => ["route" => "stores.crowdox.countries"],
    "name" => "CrowdOx Countries"
])



@endsection
