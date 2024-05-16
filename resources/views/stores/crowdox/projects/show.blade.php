@extends('stores.crowdox.projects.layout', ["title" => "Show"])

@section('page')

<div class="card">
    <form action="{{ route('stores.crowdox.projects.customfields.import', $crowdox_project) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning">Import CrowdOx Project Custom Fields</button>
    </form>
</div>

<div class="card col-md-8 offset-md-2">
    <div class="card-header">Custom Fields</div>
    <div class="card-body">
        @foreach($crowdox_project->crowdOxProjectCustomFields as $custom_field)
        <pre>
        {!! nl2br(json_encode(json_decode($custom_field->raw_data), JSON_PRETTY_PRINT))!!}
        </pre>
        @endforeach
    </div>
</div>


<div class="card col-md-8 offset-md-2">
    <div class="card-header">Raw Data</div>
    <div class="card-body">
        <pre>
        {!! nl2br(json_encode(json_decode($crowdox_project->raw_data), JSON_PRETTY_PRINT))!!}
        </pre>
    </div>
</div>



@endsection
