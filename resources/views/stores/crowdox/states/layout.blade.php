@extends('layouts.main', ["title" => "CrowdOx States - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx States..</p>
    <a href="{{ route('stores.crowdox.states.index') }}" class="btn btn-primary">CrowdOx States Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
