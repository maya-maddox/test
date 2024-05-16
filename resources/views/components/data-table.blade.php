@php
$notResponsive = $notResponsive ?? false;
@endphp
<table class="table table-striped @if(!$notResponsive) table-responsive @endif">
    <thead>
        <tr>
            @foreach($headers as $header)
            <td>{{ $header }}</td>
            @endforeach
            @if(isset($routes) && in_array("show", $routes))
            <td>Show</td>
            @endif
            @if(isset($routes) && in_array("edit", $routes))
            <td>Edit</td>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse($data as $d)
        <tr>
            @foreach($keys as $key)
            <td class="{{ $key }}_label">
                @if(isset($key_style) && array_key_exists($key, $key_style) && $key_style[$key] == "escaped")
                    {!! nl2br(is_array($d) ? Arr::get($d, $key) : $d->$key) !!}
                @elseif(isset($key_style) && array_key_exists($key, $key_style) && $key_style[$key] == "link" && (is_array($d) ? Arr::get($d, $key) : $d->$key) != '')
                    <a href="{{ is_array($d) ? Arr::get($d, $key) : $d->$key }}" target="_blank" class="btn-block">
                        <i class="fas fa-link"></i>
                    </a>
                @elseif(isset($key_style) && array_key_exists($key, $key_style) && $key_style[$key] == "form")
                    <form action="{{ is_array($d) ? Arr::get(Arr::get($d, $key), 'route') : Arr::get($d->$key, 'route') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-{{ is_array($d) ? Arr::get(Arr::get($d, $key), 'style') : Arr::get($d->$key, 'style') }}">{{ is_array($d) ? Arr::get(Arr::get($d, $key), 'text') : Arr::get($d->$key, 'text') }}</button>
                    </form>
                @elseif(isset($key_style) && array_key_exists($key, $key_style) && $key_style[$key] == "array")
                    {{ implode(", ", is_array($d) ? Arr::get($d, $key) : $d->$key) }}
                @elseif(isset($key_style) && array_key_exists($key, $key_style) && explode(".", $key_style[$key])[0] == "array")
                    {{ implode(", ", Arr::pluck(is_array($d) ? Arr::get($d, $key) : $d->$key, explode(".", $key_style[$key])[1])) }}
                @elseif (is_bool(Arr::get($d, $key)))
                    <i class="fas {{ (is_array($d) ? Arr::get($d, $key) : $d->$key) ? "fa-check-circle" : "fa-times-circle" }}"></i>
                @elseif(str_contains($key, '.'))
                    {{ Arr::get($d, $key) }}
                @elseif(isset($key_style) && array_key_exists($key, $key_style) && $key_style[$key] == "human_date")
                    <span data-toggle="tooltip" title="{{ optional((is_array($d) ? Arr::get($d, $key) : $d->$key))->isoFormat('YYYY-MM-DD HH:mm:ss z') }}">{{ str_replace(['hours', 'hour', 'minutes', 'minute', 'seconds', 'second'], ['h', 'h', 'm', 'm', 's', 's'], optional((is_array($d) ? Arr::get($d, $key) : $d->$key))->diffForHumans()) }}</span>
                @else
                    {{ is_array($d) ? Arr::get($d, $key) : $d->$key }}
                @endif
            </td>
            @endforeach
            @if(isset($routes) && in_array("show", $routes))
            <td><a href="{{ route($routes['route'].'.show', $d) }}" class="btn-block">
                <i class="fas fa-search"></i>
            </a></td>
            @endif
            @if(isset($routes) && in_array("edit", $routes))
            <td><a href="{{ route($routes['route'].'.edit', $d) }}" class="btn-block">
                <i class="fas fa-pencil-alt"></i>
            </a></td>
            @endif
        </tr>
        @empty
        <tr class="text-center">
            <td colspan="{{ count($keys) + (isset($routes) ? (count($routes) - 1) : 0) }}">No {{ $name ?? 'Items' }} Present</td>
        </tr>
        @endforelse

        @if(isset($routes) && in_array("create", $routes))
        <tr class="text-center">
            <td colspan="{{ count($keys) + count($routes) - 1 }}">
                <a href="{{ route($routes['route'].'.create')}}" class="btn-block"><i class="fas fa-plus-circle"></i></a>
            </td>
        </tr>
        @endif
    </tbody>
</table>

@if($data instanceof \Illuminate\Pagination\AbstractPaginator)
{{ $data->links() }}
@endif
