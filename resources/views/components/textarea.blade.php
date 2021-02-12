<div class="form-group {{ $col ?? '' }} {{ $required ?? '' }}">
    <label for="{{ $name }}">{{ $labelName }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control {{ $name }}" cols="{{ $cols ?? '30' }}" rows="{{ $rows ?? '10' }}" placeholder="{{ $placeholder ?? '' }}"></textarea>
</div>