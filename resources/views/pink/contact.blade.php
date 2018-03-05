@extends(env('THEME') . '.layouts.site')

@section('nav')
    {!! $nav !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('sidebar')
    {!! $sidebarLeft !!}
@endsection

@section('footer')
    {!! $footer !!}
@endsection