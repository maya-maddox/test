@extends('layouts.main', ["title" => "CrowdOx Order Address - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Order Address..</p>
    <a href="{{ route('stores.crowdox.orderaddresses.index') }}" class="btn btn-primary">CrowdOx Order Address Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
