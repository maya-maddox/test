@extends('layouts.main', ["title" => "CrowdOx Orders - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Orders..</p>
    <a href="{{ route('stores.crowdox.orders.index') }}" class="btn btn-primary">CrowdOx Orders Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
