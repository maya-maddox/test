@extends('tools.service-center.layout', ["title" => "Create New Service Centre"])

@section('page')
<div class="card my-4 col-12 p-0">
    <div class="card-body alert-secondary text-center">
        <form action="{{ route('tools.servicecenter.store') }}" method="POST">
            @csrf
            @include('components.forms.text-entry', ["id" => "name", "label" => "Name"])
            @include('components.forms.text-entry', ["id" => "code", "label" => "Code"])
            @include('components.forms.text-entry', ["id" => "location", "label" => "Location"])

            @include('components.forms.options-entry', ["id" => "timezone", "label" => "Timezone", "options" => array_combine(DateTimeZone::listIdentifiers(), DateTimeZone::listIdentifiers())])

            <button type="submit" class="btn btn-success">Create</button>
            <a class="btn btn-danger" href="{{ route('tools.servicecenter.index') }}">Cancel/Return</a>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        var tz = moment.tz.guess();
        let tzSelector = document.getElementById("timezone");
        tzSelector.value = tz;
    })
</script>
@endsection