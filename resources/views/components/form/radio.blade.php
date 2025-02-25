@props([
    'name', 'options', 'id', 'checked' => false
])

@foreach($options as $value => $text)

    <div class="form-check">
        <input class="form-check-input" type="radio" name="{{ $name }}" id="{{$name}}" value="{{ $value }}"
            @checked(old($name, $checked) == $value)
            {{ $attributes->class([
            'form-control',
            'is-invalid' => $errors->has($name)
            ]) }}
        >
        <label class="form-check-label" for="{{$name}}">
            {{$text}}
        </label>
    </div>
@endforeach
