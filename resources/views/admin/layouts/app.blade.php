<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/datatables.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/timepicker.css')}}">
        <link href="{{ asset('booking/css/main.css') }}" rel="stylesheet" />
        @yield('css')
    </head>
    <body class="{{ $class ?? '' }}">
    <div class="wrapper">
        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
            @include('front.layouts.footer')
        </div>
    </div>
    <script src="{{ asset('booking/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('booking/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('booking/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('booking/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('booking/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    @yield('script')
    @stack('js')
    <script>
        $( document ).ready(function(){
            $(".alert").fadeTo(4000, 600).slideUp(600, function(){
                $(".alert").slideUp(600);
            });
        });
    </script>
    @stack('js')
    </body>
</html>
