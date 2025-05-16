@foreach ($cmsSections as $section)
    @switch($section->section_name)

        @case('usermanual')
            @include('usermanual', ['manuals' => $manuals])
            @break

        @case('CustomerSupport')
            @include('CustomerSupport', ['contacts' => $contacts])
            @break

        @case('watchourvideos')
            @include('watchourvideos', ['videos' => $videos])
            @break

        @default
            <p>Unknown section: {{ $section->section_name }}</p>
    @endswitch
@endforeach
