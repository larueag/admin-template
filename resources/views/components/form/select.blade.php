@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control';
    } else {
        $attributes['class'] = 'form-control '.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }

    $request_name = $name;
    if(isset($attributes['multiple']))
        $request_name = substr($name, 0, -2);

    if($errors->has($name)) {
        $attributes['class'] .= ' is-invalid';
    }

@endphp
<div class="form-group{{ $errors->has($request_name) ? ' has-error' : '' }}">
    @if(!is_null($label))
        {{ Form::label($name, $label, $errors->has($name) ? ['class' => 'text-danger'] : null) }}
    @endif
    {{ Form::select($name, $value, $default_value, $attributes) }}

    @if($errors->has($request_name))
        <span class="invalid-feedback">{{ $errors->first($request_name) }}</span>
    @endif
</div>
