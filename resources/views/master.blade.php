<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portal Fornecedores | @yield('title')</title>
    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{ asset('css/fontawesome/font-awesome.min.css') }}"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('css/ionicons/ionicons.min.css') }}">

    @if(config('adminlte.plugins.select2'))
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    @endif

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte/AdminLTE.min.css') }}">

    @if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.dataTable.css') }}">
    @endif

    @yield('adminlte_css')

    <link href="{{ asset('css/easy-autocomplete.themes.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/easy-autocomplete.min.css') }}" rel="stylesheet">
    <link href="{{ asset('multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">
    <div class="content-fluid">

        <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.easy-autocomplete.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/Chart.bundle.min.js') }}"></script>

        @yield('body')

        @if(config('adminlte.plugins.select2'))
            <!-- Select2 -->
            <script src="{{ asset('js/select2.min.js') }}"></script>
        @endif

        @if(config('adminlte.plugins.datatables'))
            <!-- DataTables -->
            <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        @endif

        @yield('adminlte_js')
    </div> <!-- FIM div.content-fluid -->

</body>
</html>
