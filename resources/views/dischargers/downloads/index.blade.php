@extends('dischargers.downloads.layout', ["title" => "Index"])

@section('page')



<div class="row">


    @foreach($downloads ?? [] as $key => $download)
    <div class="card m-3" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $download['name'] }}</h5>
            @if (key_exists("subtitle", $download))
            <h6 class="card-subtitle mb-2 text-muted">{{ $download['subtitle'] }}</h6>
            @endif
            <p class="card-text">{{ $download['description'] }}</p>
            <a href="{{ route("dischargers.downloads.download", $key) }}" class="card-link">Download</a>
            @if ($download['cached'])
            <hr>
            <p class="text-muted">Cached at: {{ $download['cached_at'] }}</p>

            <form class="m-0 p-0" action="{{ route("dischargers.downloads.refresh", $key) }}" method="post">
                @csrf
                <button class="m-0 p-0 btn btn-link" action="submit">Refresh</button>
            </form>
            @endif
        </div>
      </div>
    @endforeach
</div>

@endsection
