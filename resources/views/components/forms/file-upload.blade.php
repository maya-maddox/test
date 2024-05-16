<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">{{ $label }}</label>
    <div class="col-sm-10">
        <input type="{{ $type ?? 'file' }}"
            class="form-control {{ $errors->has($id) ? ' is-invalid' : '' }}"
            id="{{ $id }}"
            name="{{ $id }}"
            {{ isset($required) && $required ? 'required' : ''}}
            {{ isset($accept) ? "accept=\"{$accept}\"" : ""}}>
        @isset($help)
        <small class="form-text text-muted">{!! $help !!}</small>
        @endisset
        @error($id)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
