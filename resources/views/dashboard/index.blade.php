@extends('page')

@section('title')
Dashboard
@stop

@section('js')
<!-- JS específico da view -->
@stop

@section('content_header')
    <h1 style="height: 31px;"> 
      <ol class="breadcrumb" style="font-size: 11px;">
      	<li> <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> </a> </li>
        <li class="active">Dashboard</li>
      </ol>
  </h1>
@stop

@section('content')

<div class="col-md-12">
	<h1>Olá, {{ Auth::user()->nome }}</h1>
	<p> Está é a sua Dashboard </p>
</div>
<div class="clearblock"></div>
@stop