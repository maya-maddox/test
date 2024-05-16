@extends('tools.service-center.returns-log.layout', ["title" => "Returns Log"])

@section('page')
<div id="returnslog">
    <return-template service-center-id="{{ $service_center->id }}" return-id="{{ $return->id }}"/>
</div>
@endsection