@extends('layouts.main', ["title" => "Ingestion Tracker - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>Tracks and logs ingestions</p>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
