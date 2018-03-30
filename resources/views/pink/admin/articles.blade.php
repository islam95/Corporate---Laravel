@extends(env('THEME').'.layouts.admin')

@section('nav')
    {!! $nav !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('footer')
    {!! $footer !!}
@endsection