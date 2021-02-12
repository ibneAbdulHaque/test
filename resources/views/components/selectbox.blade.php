<div class="form-group {{ $col ?? '' }} {{ $required ?? '' }}">
    <label for="{{ $name }}">{{ $labelName }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control {{ $name }}">
        <option value="">Choose One</option>
    </select>
</div>