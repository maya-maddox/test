@props(['title', 'id', 'accordionId'])

<div class="card">
    <div class="card-header" id="heading{{ $id }}">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $accordionId }}{{ $id }}" aria-expanded="true" aria-controls="collapse{{ $accordionId }}{{ $id }}">
          {{ $title }}
        </button>
      </h5>
    </div>

    <div id="collapse{{ $accordionId }}{{ $id }}" class="collapse" aria-labelledby="heading{{ $id }}" data-parent="#accordion{{ $accordionId }}">
      <div class="card-body">
        {{ $slot }}
      </div>
    </div>
</div>
