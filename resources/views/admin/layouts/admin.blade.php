
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS AdminLTE --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    {{-- Vite / asset handling: use vite() helper when available; otherwise try dev server hot file; else use compiled assets --}}
    @if (function_exists('vite'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @elseif (file_exists(public_path('hot')))
        <script type="module" src="http://127.0.0.1:5173/@vite/client"></script>
        <script type="module" src="http://127.0.0.1:5173/resources/js/app.js"></script>
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
        <script src="{{ asset('resources/js/app.js') }}" defer></script>
    @endif

    {{-- Additional styles --}}
    @stack('styles')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Navbar --}}
        @include('admin.partials.navbar')

        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Content --}}
        <div class="content-wrapper">
            <section class="content p-3">
                @yield('content')
            </section>
        </div>

        {{-- Footer --}}
        @include('admin.partials.footer')

    </div>

    {{-- JS AdminLTE --}}
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>

</html>
