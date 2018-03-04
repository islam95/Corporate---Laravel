<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if !IE]>
<html dir="ltr" lang="en-US">
<![endif]-->

<!-- START HEAD -->
@include(env('THEME') .'.includes.header')
<!-- END HEAD -->

<!-- START BODY -->
<body class="no_js responsive {{ (Route::currentRouteName() ==  'home') || (Route::currentRouteName() == 'portfolios.index') || (Route::currentRouteName() == 'portfolios.show') ? 'page-template-home-php' : ''}} stretched">

<!-- START BG SHADOW -->
<div class="bg-shadow">

    <!-- START WRAPPER -->
    <div id="wrapper" class="group">

        <!-- START HEADER -->
        <div id="header" class="group">
            <div class="group inner">

                <!-- START LOGO -->
                <div id="logo" class="group">
                    <a href="{{ route('home') }}" title="Pink Rio"><img src="{{ asset(env('THEME')) }}/images/logo.png" title="Pink Rio" alt="Pink Rio" /></a>
                </div>
                <!-- END LOGO -->

                <div id="sidebar-header" class="group">
                    <div class="widget-first widget yit_text_quote">
                        <blockquote class="text-quote-quote">&#8220;Anyone who has never made a mistake has never tried anything new.&#8221;</blockquote>
                        <cite class="text-quote-author">Albert Einstein</cite>
                    </div>
                </div>
                <div class="clearer"></div>
                <hr />

                <!-- START MAIN NAVIGATION -->
                @yield('nav')
                <!-- END MAIN NAVIGATION -->

                <div id="header-shadow"></div>
                <div id="menu-shadow"></div>
            </div>
        </div>
        <!-- END HEADER -->

        <!-- START SLIDER -->
        @yield('slider')
        <!-- END SLIDER -->

        <div class="wrap_result"></div>

        @if(Route::currentRouteName() == 'portfolios.index')
            <!-- START PAGE META -->
            <div id="page-meta">
                <div class="inner group">
                    <h3>Welcome to my portfolio page</h3>
                    <h4>... i hope you enjoy my works</h4>
                </div>
            </div>
            <!-- END PAGE META -->
        @endif

        <div id="primary" class="sidebar-{{ isset($sidebar) ? $sidebar : 'no' }}">
            <div class="inner group">
                <!-- START CONTENT -->
                @yield('content')
                <!-- END CONTENT -->

                <!-- START SIDEBAR -->
                @yield('sidebar')
                <!-- END SIDEBAR -->
            </div>
        </div>

        <!-- START COPYRIGHT -->
        @yield('footer')
        <!-- END COPYRIGHT -->

    </div>
    <!-- END WRAPPER -->
</div>
<!-- END BG SHADOW -->

<script type="text/javascript" src="{{ asset(env('THEME')) }}/js/jquery.custom.js"></script>
<script type="text/javascript" src="{{ asset(env('THEME')) }}/js/contact.js"></script>
<script type="text/javascript" src="{{ asset(env('THEME')) }}/js/jquery.mobilemenu.js"></script>

</body>
<!-- END BODY -->
</html>
