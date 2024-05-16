<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-4 col-form-label">{{ $label }}</label>
    <div class="input-group col-sm-8">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ $currency }}</span>
        </div>
        <input type="{{ $type ?? 'text' }}"
            class="form-control {{ $errors->has($id) ? ' is-invalid' : '' }}"
            id="{{ $id }}"
            name="{{ $id }}"
            value="{{ old($id, $value ?? '') }}"
            {{ isset($required) && $required ? 'required' : ''}}>
        @isset($help)
        <small class="form-text text-muted">{{ $help }}</small>
        @endisset
        @error($id)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
