@props(['accordionId'])

<div class="accordion col-12" id="accordion{{ $accordionId }}">
{{ $slot}}
</div>
