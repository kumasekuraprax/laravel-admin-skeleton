@extends('master')

@php $skin = config('adminlte.skin') == null ? blue-light : config('adminlte.skin'); @endphp

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/adminlte/skins/skin-' . $skin . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . $skin . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@php $adminlte = config('adminlte') @endphp

@section('body')
    <div class="wrapper">
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'dashboard')) }}" class="navbar-brand">
                            <img src="{{ asset('images/logos/logo-madeiramadeira-header.jpg') }}" class="img-responsive" style="margin: 7px 0;">
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('partials.menu-item-top-nav', $adminlte['menu'], 'item')
                        </ul>
                    </div>
            @else
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <span class="logo-mini">
                    <img src="{{ asset('images/logos/logo-madeiramadeira-mini.png') }}" style="width: 30px; text-align: center;">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('images/logos/logo-madeiramadeira-header.jpg') }}" class="img-responsive" style="margin: 7px 0;">
                </span>
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <i class="fa fa-bars"></i>
                </a>
            @endif
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <!-- Notifications Menu -->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"></li>
                                <li>
                                    <ul class="menu"></ul>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="dropdown user user-menu">
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">  
                                <span class="fa fa-user"></span>
                                <span class="hidden-xs">{{ Auth::user()->nome }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                
                                <li class="user-header" style="height: 80px;">
                                    <p> {{ Auth::user()->nome }} </p>
                                </li>
                                
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('usuarios.edit', Auth::id()) }}" class="btn btn-default btn-flat">Meus Dados</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-danger btn-flat" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-fw fa-power-off"></i> Finalizar Sessão
                                        </a>
                                    </div>

                                    {{ Form::open(['url' => '/logout', 'method' => 'post', 'style' => 'display: none;', 'id' => 'logout-form']) }}
                                        @if(config('adminlte.logout_method'))
                                            {{ method_field(config('adminlte.logout_method')) }}
                                        @endif
                                    {{ Form::close() }}
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    @each('partials.menu-item', $adminlte['menu'], 'item')
                </ul>
            </section>
        </aside>
        @endif

        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <section class="content-header">
                @yield('content_header')
            </section>

            <section class="content">

                @yield('content')

            </section>
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            @endif
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Versão</b> {{ config('app.version') }}
            </div>
            <strong>Copyright © <a href="https://www.madeiramadeira.com.br/seguranca" target="blank">madeiramadeira</a>.</strong> Todos os direitos reservados!
        </footer>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('js/adminlte/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/maskJS/src/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/maskMoneyJS/src/jquery.maskMoney.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
