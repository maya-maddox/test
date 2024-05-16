@extends('stores.swytch.sku-type.layout', ["title" => "Index"])

@section('page')
<a href="{{route('stores.swytch.sku-type.index')}}" class="btn btn-primary">Back to SKU Types</a>
<div class="card my-3 col-4 offset-3">
    <div class="card-body p-0">
        <h5>SKU Type: <strong>{{ $skuType->type }}</strong></h5>
    </div>
</div>
<div class="card my-3 col-4 offset-3">
    <div class="card-body p-0">
        @forelse ($skuType->returnItemDiagnoses as $diagnosis)
        <strong>{{$diagnosis->diagnosis}}</strong>
        <hr>
        @empty
        <i>No Diagnosis for this type!</i>
        @endforelse
    </div>
</div>
<div class="card my-3 col-6 offset-2">
    <div class="card-body p-0">
        <form action="{{ route('stores.swytch.sku-type.diagnosis.store', $skuType) }}" method="POST">
            @csrf

            @include('components.forms.text-entry', ["id" => "diagnosis", "label" => "Diagnosis", "required", "largeLabel" => true])

            <button type="submit" class="btn btn-primary">Add Diagnosis</button>
        </form>
    </div>
</div>



@endsection
