@extends('layouts.main', ["title" => (optional($service_center ?? null)->name." ")."Service Centre - ".$title])

@section('content')
@if($service_center ?? null)
<div class="alert alert-secondary my-3 row" role="alert">
    <p class="col-2">Service Centre - {{optional($service_center ?? null)->name}}</p>
    <a href="{{ route('tools.servicecenter.index') }}" class="btn btn-secondary col-2">Change</a>

    <div class="col-3">
    @include('components.array-route-list', [
        "entries" => config('tools.servicecenter.tools'),
        "route_prefix" => "tools.servicecenter.",
        "route_args" => [$service_center->id],
        "confirm" => true
    ])
    </div>
</div>
@endif

<div class="container-fluid">
    @yield('page')
</div>


@endsection
