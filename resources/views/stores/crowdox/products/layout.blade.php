@extends('layouts.main', ["title" => "CrowdOx Products - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Products..</p>
    <a href="{{ route('stores.crowdox.products.index') }}" class="btn btn-primary">CrowdOx Products Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
