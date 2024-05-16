<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">{{ $label }}</label>
    <div class="col-sm-10">
        <textarea type="{{ $type ?? 'text' }}"
            class="form-control {{ ($errors->has($id) | $errors->has($id.'*')) ? ' is-invalid' : '' }}"
            id="{{ $id }}"
            name="{{ $id }}"
            placeholder="{{ $placeholder ?? ''}}"
            {{ isset($required) && $required ? 'required' : ''}}
            rows="{{ $rows ?? 5 }}">{!! old($id, $value ?? "") !!}</textarea>
        @isset($help)
        <small class="form-text text-muted">{{ $help }}</small>
        @endisset
        @error($id)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @error($id.'.*')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
