@extends('layouts.app')
@section('title', 'Library Management System')
@section('content')

<section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp"
style="padding: 5px;">
    @foreach($classes_tree as $key => $value)
    <a href="#{{ $key }}">
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="$('.book-category').hide();$('#{{ $key }}').show();">
            {{ $key }}&nbsp;{{ $classes_tree[$key][$key][$key][0] }}
        </button>
    </a>
    @endforeach
</section>
@foreach($classes_tree as $keyword => $value)
<section class="section--center mdl-grid mdl-grid--no-spacing book-category" id="{{ $keyword }}" style="display: none;">
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
            <tr>
                <th colspan="2" class="mdl-data-table__cell--non-numeric">
                    <a href="/class/{{ $keyword }}/page/1" name="{{ $keyword }}" target="_blank">
                        <h4>
                            {{ $keyword }} &nbsp;{{ $classes_tree[$keyword][$keyword][$keyword][0]
                            }}
                        </h4>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($value as $key => $val) @if($key != $keyword)
            <tr>
                <td class="mdl-layout--large-screen-only mdl-data-table__cell--non-numeric" style="width: 20%;">
                    <a href="/class/{{ $key }}/page/1" target="_blank">
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                            {{ $key }}&nbsp; @if( !empty($classes_tree[$keyword][$key][$key][0]) )
                            {{ $classes_tree[$keyword][$key][$key][0] }} @endif
                        </button>
                    </a>
                </td>
                <td class="mdl-data-table__cell--non-numeric">
                    @foreach($val as $k => $v) @if( $k!=$key )
                    <a href="/class/{{ $k }}/page/1" target="_blank">
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                            {{ $k }}&nbsp;{{ $v[0] }}
                        </button>
                    </a>
                    @endif @endforeach
                </td>
            </tr>
            @endif @endforeach
        </tbody>
    </table>
</section>
@endforeach
                    {{-- var_dump($classes_tree) --}}

@endsection
