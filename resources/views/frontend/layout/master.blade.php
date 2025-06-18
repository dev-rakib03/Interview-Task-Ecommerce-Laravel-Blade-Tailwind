<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layout.partials.meta')
    <title>@yield('title',env('APP_NAME'))</title>
    @include('frontend.layout.partials.css')
</head>
<body class="flex flex-col min-h-screen">
    @include('frontend.layout.partials.header')
    <main>
        @yield('content')
    </main>
    @include('frontend.layout.partials.footer')
    @include('frontend.layout.partials.mobile_bottom_nav')
    @include('frontend.layout.partials.js')
</body>
</html>