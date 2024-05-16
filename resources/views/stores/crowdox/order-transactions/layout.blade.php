@extends('layouts.main', ["title" => "CrowdOx Order Transactions - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Order Transactions..</p>
    <a href="{{ route('stores.crowdox.ordertransactions.index') }}" class="btn btn-primary">CrowdOx Order Transactions Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
