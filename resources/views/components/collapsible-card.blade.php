<div class="card col-12 p-0">
    <div class="card-header " data-toggle="collapse" data-target="#collapse{{str_replace(" ", "-", $title)}}">
        {{ $title }}
    </div>
    <div class="card-body show collapse" id="collapse{{str_replace(" ", "-", $title)}}">
        {{ $slot }}
    </div>
</div>