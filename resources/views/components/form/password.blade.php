@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control';
    } else {
        $attributes['class'] = 'form-control '.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }

    if($errors->has($name)) {
        $attributes['class'] .= ' is-invalid';
    }
@endphp
<div class="form-group">
    @if(!is_null($label))
        {{ Form::label($name, $label, $errors->has($name) ? ['class' => 'text-danger'] : null) }}
    @endif
    {{ Form::password($name, $attributes) }}
    @if($errors->has($name))
        <span class="invalid-feedback">{{ $errors->first($name) }}</span>
    @endif
</div>
