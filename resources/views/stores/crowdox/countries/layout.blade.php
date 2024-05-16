@extends('layouts.main', ["title" => "CrowdOx Countries - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Countries..</p>
    <a href="{{ route('stores.crowdox.countries.index') }}" class="btn btn-primary">CrowdOx Countries Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
