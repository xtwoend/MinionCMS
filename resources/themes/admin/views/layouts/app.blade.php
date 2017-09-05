<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-pjax-version" content="1">

    <title>@yield('title', 'MinionCMS')</title>
    
    <!-- Styles -->
    <link href="{{ theme_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/other.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/notify/notiny.css') }}"  rel="stylesheet">
    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body class="">
    <section class="vbox" id="app">

        @include('layouts.header')
        <section>
            <section class="hbox stretch">
                {{-- aside --}}
                @if(! Auth::guest())
                    @include('layouts.aside')
                @endif
                <section id="content">
                    <section class="vbox stretch" id="bjax-el">
                            @yield('content')
                    </section>
                </section>
            </section>
        </section>
    </section>
    
    @yield('modal')

    <!-- Scripts -->
    <script src="{{ theme_asset('js/app.js') }}"></script>
    <script src="{{ theme_asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/notify/notiny.js') }}"></script>

    @yield('js')
    
</body>
</html>
