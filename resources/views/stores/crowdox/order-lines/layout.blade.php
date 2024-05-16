@extends('layouts.main', ["title" => "CrowdOx Order Lines - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Order Lines..</p>
    <a href="{{ route('stores.crowdox.orderlines.index') }}" class="btn btn-primary">CrowdOx Order Lines Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
