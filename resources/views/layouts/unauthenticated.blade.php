@extends('layouts.base')

@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Swytch Internal Tools</a>

        @if ($title ?? null)
        <ul class="navbar-nav mr-auto">
            <p class="navbar-brand m-0">{{ $title }}</p>
        </ul>
        @endif
    </nav>
@endsection
