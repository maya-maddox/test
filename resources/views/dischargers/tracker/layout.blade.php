@extends('layouts.main', ["title" => "Discharge Tracker - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>Tracks and logs disacharges</p>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
