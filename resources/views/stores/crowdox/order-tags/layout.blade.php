@extends('layouts.main', ["title" => "CrowdOx Order Tags - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Order Tags..</p>
    <a href="{{ route('stores.crowdox.ordertags.index') }}" class="btn btn-primary">CrowdOx Order Tags Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
