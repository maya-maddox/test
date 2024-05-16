@foreach($entries as $route => $name)
    @if ($name === null)
    <p></p>
    @elseif (is_array($name))
    <p></p>
    <li><b>{{$route}}</b>
        <ul>
        @include('components.array-route-list', [
            "entries" => $name
        ])
        </ul>
    </li>
    @else
    <li><a href="{{ route(($route_prefix ?? '').$route, ($route_args ?? null)) }}" {!! ($confirm ?? null) ? "onclick=\"return confirm('Are you sure?')\"" : ''!!}>{{ $name }}</a></li>
    @endif
@endforeach