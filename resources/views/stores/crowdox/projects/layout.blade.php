@extends('layouts.main', ["title" => "CrowdOx Projects - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Projects..</p>
    <a href="{{ route('stores.crowdox.projects.index') }}" class="btn btn-primary">CrowdOx Projects Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
