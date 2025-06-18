<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.partials.meta')
    <title>@yield('title', env('APP_NAME'))</title>
    @include('admin.layout.partials.css')
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    @include('admin.layout.partials.header')
    @include('admin.layout.partials.sidebar')
    <main class="pt-14 md:pl-64 transition-all min-h-screen">
        <div class="p-6">
            @yield('content')
        </div>
    </main>
    @include('admin.layout.partials.footer')

    @include('admin.layout.partials.js')
</body>

</html>
