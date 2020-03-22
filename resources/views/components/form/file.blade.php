@php
    if (!isset($attributes['class'])) {
        $attributes['class'] = 'form-control';
    } else {
        $attributes['class'] = 'form-control '.$attributes['class'];
    }

    if (isset($action) && $action == 'edit' && !$errors->all()) {
        $attributes['disabled'] = 'disabled';
    }
@endphp
<div class="form-group m-0{{ $errors->has($name) ? ' has-error' : '' }}">
    @if(!is_null($label))
        {{ Form::label($name, $label, $errors->has($name) ? ['class' => 'text-danger'] : null) }} <br>
    @endif
    <span class="file-selector">
        <label class="btn btn-block bg-gradient-light{{ isset($attributes['disabled']) ? ' disabled' : ''}}">
            {{ Form::file($name, $attributes) }}
            <i class="fa fa-upload icon-upload-alt margin-correction"></i> <span class="filename">selecione um arquivo...</span>
        </label>
    </span>
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>
