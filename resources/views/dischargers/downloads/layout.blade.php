@extends('layouts.main', ["title" => "Downloads - ".$title])

@section('content')
<div class="alert alert-secondary my-3" role="alert">
    <p>Downloads..</p>
</div>

<div class="row">
    @yield('page')
</div>


@endsection
