<input type="text" name="{{ $name }}" id="{{ $id }}"
       form="{{ $formId }}"
       class="{{ $class }}" value="{{ request($name) }}" title="@lang('Filter by') {{ __($titleSetOnColumn ?? $title) }}" placeholder="@lang('Filter by') {{ __($titleSetOnColumn ?? $title) }}"
       @foreach($dataAttributes as $k => $v)
       data-{{ $k }}={{ $v }}
        @endforeach
>