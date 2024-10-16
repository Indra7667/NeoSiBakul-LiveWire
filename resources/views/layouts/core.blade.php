<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/core/images/system/logo.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dependencies -->
    <link rel="stylesheet" href="{{ asset('core/cdn/bootstrap-icons-1.11.3/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('core/cdn/sweetalert2/sweetalert2 v11.10.7.min.css') }}">
</head>

<body class="font-sans antialiased max-w-screen">
    @yield('layout')

    <script src="{!! asset('core/cdn/jquery/jquery-3.7.1.min.js') !!}"></script>

    <script src="{!! asset('core/cdn/sweetalert2/sweetalert2 v11.10.7.min.js') !!}"></script>
    
    <!-- toast control -->
    <script src="{!! asset('js/toast.js') !!}"></script>
    @if (!empty(session()->get('singularToast')))
    <script>
        let toastData = {!! session()->get('singularToast') !!};
        singularToast(toastData.title, toastData.label, toastData.icon);
        </script>
    @endif
    <!-- toast control end -->
    
    @if (in_array('jspdf', $coredata['dependency']))
        <script src="{!! asset('core/cdn/jspdf/jspdf 2.5.1.umd.min.js') !!}"></script>
        <script src="{!! asset('core/cdn/jspdf/pollyfills/polyfills 2.5.1.umd.min.js') !!}"></script>
    @endif

    @if (in_array('leaflet', $coredata['dependency']))
        <script src="{!! asset('core/cdn/jspdf/jspdf 2.5.1.umd.min.js') !!}"></script>
    @endif

    @if (in_array('qrcodejs', $coredata['dependency']))
        <script src="{!! asset('core/cdn/qrcodejs/qrcodejs.min.js') !!}"></script>
    @endif

    @if (in_array('tableToExcel', $coredata['dependency']))
        <script src="{!! asset('core/cdn/tableToExcel/tableToExcel.min.js') !!}"></script>
    @endif

    @if (in_array('trumbowyg', $coredata['dependency']))
        <script src="{!! asset('core/cdn/trumbowyg/trumbowyg v2.27.3.min.js') !!}"></script>
    @endif

    @if (in_array('OwlCarousel', $coredata['dependency']))
        <link rel="stylesheet" href="{{ asset('core/cdn/OwlCarousel2-2.3.4/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('core/cdn/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}">
        <script src="{!! asset('core/cdn/OwlCarousel2-2.3.4/owl.carousel.min.js') !!}"></script>
    @endif

    @if (in_array('apexChart', $coredata['dependency']))
        <script src="{!! asset('core/cdn/apexChart/apexChart.min.js') !!}"></script>
    @endif
    {{-- <script src="{{ asset('core/cdn/flowbite/flowbite.min.js') }}"></script> --}}
    <!-- Dependencies end -->
</body>

</html>
