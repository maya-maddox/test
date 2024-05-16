@extends('layouts.main', ["title" => "CrowdOx Customers - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Customers..</p>
    <a href="{{ route('stores.crowdox.customers.index') }}" class="btn btn-primary">CrowdOx Customers Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
