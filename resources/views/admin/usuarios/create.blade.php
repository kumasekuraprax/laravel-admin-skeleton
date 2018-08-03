@extends('page')

@section('title')
Admin - Novo Usuário
@stop

@section('css')
<!-- CSS especifico da view -->
@stop

@section('js')
<!-- JS especifico da view -->
<script type="text/javascript" src="{{ asset('js/admin/usuarios.js') }}"></script>
@stop

@section('content_header')
    <h1 style="height: 31px;"> 
      <ol class="breadcrumb" style="font-size: 11px;">
        <li> <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> </a> </li>
        <li>Controles</li>
        <li> <a href="{{ route('usuarios.index') }}"> Usuários </a></li> 
        <li class="active">Novo Usuário</li>
      </ol>
  </h1>
@stop

@section('content')
<div class="box box-success">
    
    {{ Form::open(['url' => '/admin/usuarios', 'method' => 'POST']) }}
        <div class="box-header with-border">
            <h4>
                Novo usuário
                <span class="pull-right-container">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-default btn-flat pull-right">
                        CANCELAR
                    </a>
                    {{ Form::button('<i class="fa fa-repeat"></i> GRAVAR', ['class' => 'btn btn-flat btn-success pull-right', 'name' => 'update-usuario', 'type' => 'submit']) }}
                </span>
            </h4>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="form-group">
                        <label>Nome</label>
                        {{ Form::text('nome', null, ['class' => 'form-control', 'required']) }}
                    </div>

                    <div class="form-group">
                        <label>CPF</label>
                        {{ Form::text('cpf', null, ['class' => 'form-control mask_cpf', 'required']) }}
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
                    </div>

                    <div class="form-group">
                        <label>Função</label>
                        {{ Form::select('funcao[]', $roles, array_keys($usuario->getRoles()), ['class' => 'form-control', 'required', 'multiple']) }}
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}

    <div id="loader" class="overlay hide">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div> <!-- END div.box -->

@endsection