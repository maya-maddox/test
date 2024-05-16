@extends('stores.crowdox.projects.layout', ["title" => "Index"])

@section('page')


<div class="card">
    <form action="{{ route('stores.crowdox.projects.import') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Projects</button>
    </form>

</div>

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Name", "Currency", "CrowdOx Link"],
    "data" => $crowdox_projects,
    "keys" => ["crowd_ox_id", "name", "currency", "crowdOxLink"],
    "key_style" => ["crowdOxLink" => "link"],
    "routes" => ["route" => "stores.crowdox.projects", "show"],
    "name" => "CrowdOx Projects"
])



@endsection
