@extends('layouts.main', ["title" => "CrowdOx Project Custom Fields - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Project Custom Fields..</p>
    <a href="{{ route('stores.crowdox.projectcustomfields.index') }}" class="btn btn-primary">CrowdOx Project Custom Fields Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
