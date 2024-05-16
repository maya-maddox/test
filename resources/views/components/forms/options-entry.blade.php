<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-{{ ($largeLabel ?? false) ? '4' : '2' }} col-form-label">{{ $label }}</label>
    <div class="col-sm-{{ ($largeLabel ?? false) ? '8' : '10' }}">
        <select
            class="form-control {{ $errors->has($id) ? ' is-invalid' : '' }}"
            id="{{ $id }}"
            name="{{ $id }}">
            @foreach($options as $key => $option)
                @if(is_object($option))
                <option value="{{$option->value}}" {{ $option->value == old($id, $value ?? '') ? 'selected="selected"' : ''}} {{ optional($option)->disabled ? 'disabled' : ''}}>{{ $option->text }}</option>
                @else
                <option value="{{$key}}" {{ $key == old($id, $value ?? '') ? 'selected="selected"' : ''}}>{{ $option }}</option>
                @endif
            @endforeach
        </select>
        @isset($help)
        <small class="form-text text-muted">{!! $help !!}</small>
        @endisset
        @error($id)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
