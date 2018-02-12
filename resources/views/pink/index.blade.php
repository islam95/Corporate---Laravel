@extends(env('THEME') . '.layouts.site')

@section('nav')
    {!! $nav !!}
@endsection

@section('slider')
    {!! $slides !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

