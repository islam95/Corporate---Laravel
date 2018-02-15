@extends(env('THEME') . '.layouts.site')

@section('nav')
    {!! $nav !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('sidebar')
    {!! $sidebarRight or '' !!}
@endsection

@section('footer')
    {!! $footer !!}
@endsection