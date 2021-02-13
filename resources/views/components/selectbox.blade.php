<div class="form-group {{ $col ?? '' }} {{ $required ?? '' }}">
    <label for="{{ $name }}">{{ $labelName }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control {{ $name }}" @if (!empty($onchange)) onchange= "{{ $onchange }}" @endif>
        <option value="">Choose One</option>
        {{ $slot }}
    </select>
</div>