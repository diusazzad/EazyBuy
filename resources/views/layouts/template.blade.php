<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <header>
        <x-template.header />
    </header>

    <main>
        <!-- Hero Component -->
        <x-template.hero />

        <!-- Call to Action Component -->
        <x-template.call-to-action />

        @yield('content')

        <!-- Trending Products Component -->
        <x-template.trending />

        <!-- Banner Area Component -->
        <x-template.banner-area />

        <!-- Shipping Information Component -->
        <x-template.shipping-info />
    </main>

    <footer>
        <x-template.footer />
    </footer>

    @stack('scripts')
</body>

</html>