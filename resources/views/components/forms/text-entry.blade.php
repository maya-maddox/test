<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-{{ ($largeLabel ?? false) ? '4' : '2' }} col-form-label">{{ $label }}</label>
    <div class="col-sm-{{ ($largeLabel ?? false) ? '8' : '10' }}">
        <input type="{{ $type ?? 'text' }}"
            class="form-control {{ $errors->has($id) ? ' is-invalid' : '' }}"
            id="{{ $id }}"
            name="{{ $id }}"
            placeholder="{{ $placeholder ?? ''}}"
            value="{{ old($id, $value ?? '') }}"
            {{ isset($required) && $required ? 'required' : ''}}>
        @isset($help)
        <small class="form-text text-muted">{!! $help !!}</small>
        @endisset
        @error($id)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
