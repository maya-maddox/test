@extends('layouts.main', ["title" => "CrowdOx Product Variations - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>CrowdOx Product Variations..</p>
    <a href="{{ route('stores.crowdox.productvariations.index') }}" class="btn btn-primary">CrowdOx Product Variations Index</a>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
