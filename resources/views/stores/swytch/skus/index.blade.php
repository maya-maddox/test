@extends('stores.swytch.skus.layout', ["title" => "Index"])

@section('page')


    <div class="card">
        <form action="{{ route('stores.swytch.skus.import') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-warning">Import SKUs</button>
        </form>

    </div>

    @include('components.data-table', [
        "headers" => [
            'SKU',
        ],
        "data" => $skus,
        "keys" => [
            'sku',
        ],
        "name" => "SKUs"
    ])



@endsection
