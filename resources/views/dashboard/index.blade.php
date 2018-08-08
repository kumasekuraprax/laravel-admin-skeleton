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
		@role('superadmin')
			<h4> <i class="fa fa-star"></i> Você é um superadmin </h4>
		@else
			<h4> <i class="fa fa-exclamation-triangle"></i> Esté usuário não possui roles vinculadas </h4>
		@endrole

		@permission('view.dashboard')
			<h1>Olá, {{ Auth::user()->nome }}</h1>
			<p> Está é a sua Dashboard </p>
		@else
			<p class="lead"> Você não possui permissão para visualizar esta página! </p>
		@endpermission
	</div>
	<div class="clearblock"></div>
	
@stop