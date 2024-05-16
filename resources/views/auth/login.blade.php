@extends('layouts.unauthenticated')

@section('title')
Login
@endsection

@section('content')

<div class="card mt-5 p-0 col-md-4 offset-md-4 text-center">
    <div class="card-header">
        <img src="https://www.swytchbike.com/wp-content/uploads/logo.svg" alt="Swytch Logo" class="img-fluid my-2">
    </div>
    <div class="card-body">
        Login to Swytch Internal Tools
    </div>
    <div class="card-footer">
        <form action="{{ route('auth.login') }}" method="post">
            @csrf
            @include('components.forms.text-entry', [
                "id" => "name",
                "label" => "Name",
                "largeLabel" => true
            ])
            @include('components.forms.text-entry', [
                "id" => "email",
                "label" => "Email",
                "largeLabel" => true
            ])
            <button type="submit" class="btn btn-outline-primary">Login</button>
        </form>
    </div>
</div>

@endsection
