<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-2">{{ $label }}</label>
    <div class="col-sm-10">
        <div class="form-check">
            <input type="checkbox"
                class="form-check-input {{ $errors->has($id) ? ' is-invalid' : '' }}"
                id="{{ $id }}"
                name="{{ $id }}"
                {{ old($id) == "on" || (isset($checked) && $checked) ? 'checked' : ''}}
                {{ isset($required) && $required ? 'required' : ''}}>
            @isset($help)
            <label class="form-check-label text-muted" for="{{ $id }}">{{ $help }}</label>
            @endisset
            @error($id)
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
