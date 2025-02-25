@props([
    'name', 'value' => '', 'id' => 'name', 'label' => false
])

@if($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<textarea
    id="{{ $id }}"
    name="{{$name}}"
    {{ $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name)
]) }}
>{{old($name, $value)}}</textarea>
@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
@enderror
