<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Quản lý vũ khí</title>
    @yield('extension.style')
    @include('partial.head')
</head>
<body class="nav-md">
    {{-- TODO: move these style into css file --}}
    <div class="loading-icon hide" style="z-index: 9999;position: fixed;width: 50px;height: 50px;background: transparent;margin: auto;left: 0;right: 0;bottom: 0;top: 0;">
        <img src="{{url::asset('public/images/loading.gif')}}" style="width: 100%;height: 100%">
    </div>

    <div class="container body">
        <div class="main_container">
            {{-- Left menu --}}
            @include('partial.left-nav')

            {{-- top navigation --}}
            <div class="top_nav">
                @include('partial.topnav')
            </div>

            {{-- Content --}}
            <div class="right_col" role="main">
                <div class="row">
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            @include('partial.footer')
        </div>
    </div>

    @yield('extension.js')
</body>
</html>
