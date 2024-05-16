@extends('layouts/base')

@section('navbar')
    @include('layouts.navbars.navbar-main', ["title" => $title ?? null])
@endsection
