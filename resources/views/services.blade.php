@extends('layouts.main', ["title" => "Dashboard"])

@section('content')
    @foreach(config('services.list', []) as $category => $services)
    <h1>{{ $category }}</h1>
    <ul>
    @include('components.array-route-list', [
        "entries" => $services
    ])
    </ul>
    @endforeach

@endsection
