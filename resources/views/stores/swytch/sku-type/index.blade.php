@extends('stores.swytch.sku-type.layout', ["title" => "Index"])

@section('page')

<div class="card my-3 col-4 offset-3">
    <div class="card-body p-0">
    @include('components.data-table', [
        "headers" => [
            'Types', 'SKU Count'
        ],
        "data" => $skuTypes,
        "keys" => [
            'type', 'skus_count',
        ],
        "routes" => ["route" => "stores.swytch.sku-type", "show"],
        "name" => "SKU Types",
        "notResponsive" => true
    ])
    </div>
</div>
<div class="card my-3 col-6 offset-2">
    <div class="card-body p-0">
        <form action="{{ route('stores.swytch.sku-type.store') }}" method="POST">
            @csrf

            @include('components.forms.text-entry', ["id" => "type", "label" => "Type", "required"])

            <button type="submit" class="btn btn-primary">Add SKU Type</button>
        </form>
    </div>
</div>
<div class="card my-3 col-8 offset-2">
    <div class="card-body p-0">
        <form action="{{ route('stores.swytch.sku-type.update-assignments') }}" method="POST" class="form">
            @csrf

            @foreach($skus as $sku)
                @include('components.forms.options-entry', ["id" => $sku->id, "label" => $sku->sku, "largeLabel" => true, "options" => $skuTypeOptions, "value" => $sku->sku_type_id])
            @endforeach

            <button type="submit" class="btn btn-primary">Save Assignments</button>
        </form>
    </div>
</div>



@endsection
