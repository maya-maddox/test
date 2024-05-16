@extends('tools.service-center.layout', ["title" => "Select Centre"])

@section('page')
<div class="row">
<div class="card col-6 offset-3 mt-5">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Location</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($service_centers as $service_center_option)
            <tr>
                <td>{{ $service_center_option->name }}</td>
                <td>{{ $service_center_option->code }}</td>
                <td>{{ $service_center_option->location }}</td>
                <td>
                    <form action="{{ route('tools.servicecenter.select', $service_center_option->id) }}" method="post">
                        @csrf
                        <button class="btn {{ optional($service_center)->id == $service_center_option->id ? 'btn-secondary' : 'btn-primary' }}" 
                            action="submit">Select</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colSpan=4 class="text-center">
                    <a class="btn btn-primary" href="{{ route('tools.servicecenter.create') }}">New Service Centre</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@if ($service_center)
<div class="card col-3 offset-4 mt-5 p-0">
    <div class="card-header">
        <strong>{{ $service_center->name }}</strong>
    </div>
    <div class="card-body">
        @include('components.array-route-list', [
            "entries" => config('tools.servicecenter.tools'),
            "route_prefix" => "tools.servicecenter.",
            "route_args" => [$service_center->id]
        ])
    </div>
</div>
@endif
</div>

@endsection
