@extends('stores.crowdox.project-custom-fields.layout', ["title" => "Index"])

@section('page')

@include('components.data-table', [
    "headers" => ["Crowdox ID", "Name", "Key", "Project ID"],
    "data" => $crowdox_project_custom_fields,
    "keys" => ["crowd_ox_id", "name", "key", "crowd_ox_project_id"],
    "routes" => ["route" => "stores.crowdox.projectcustomfields"],
    "name" => "CrowdOx Countries"
])



@endsection
