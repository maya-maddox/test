@extends('layouts.main', ["title" => "Dashboard"])

@section('content')
<h1>Swytch Internal Tools</h1>
    <div class="row">


        @foreach($dashboard_cards ?? [] as $dashboard_card)
        <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{ $dashboard_card['title'] }}</h5>
              @if (key_exists("subtitle", $dashboard_card))
              <h6 class="card-subtitle mb-2 text-muted">{{ $dashboard_card['subtitle'] }}</h6>
              @endif
              <p class="card-text">{{ $dashboard_card['text'] }}</p>
              <a href="{{ route($dashboard_card['route']) }}" class="card-link">{{ $dashboard_card['link_text'] }}</a>
            </div>
          </div>
        @endforeach
    </div>
@endsection
