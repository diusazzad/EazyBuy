<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.landing.head')

<body>
    <div id="app">
        @include('partials.landing.nav')

        <main style="margin-top: {{ Request::is('/') ? '-1.3em' : '2em' }}">
            @include('partials.landing.session')
            @include('partials.landing.errors')
            @yield('content')
        </main>

        @include('partials.landing.footer')
    </div>

    <script>
        $(function() {
            AOS.init();
        });
    </script>

    @yield('scripts')
</body>

</html>
