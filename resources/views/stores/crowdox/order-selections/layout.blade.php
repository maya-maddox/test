@extends('layouts.main', ["title" => "CrowdOx Order Selections - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Order Selections..</p>
    <a href="{{ route('stores.crowdox.orderselections.index') }}" class="btn btn-primary">CrowdOx Order Selections Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
