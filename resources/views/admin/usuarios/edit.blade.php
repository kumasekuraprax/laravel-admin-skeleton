@extends('page')

@section('title')
Admin - Editar Usuário {{ $usuario->nome }}
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
        <li class="active">Editando {{ $usuario->nome }}</li>
      </ol>
  </h1>
@stop

@section('content')
<div class="box box-success">
    {{ Form::hidden('id', $usuario->id) }}

    {{ Form::open(['route' => ['usuarios.update', $usuario->id], 'method' => 'PUT']) }}
    <div class="box-header with-border">
        <h4>
            Editando Usuário | {{ $usuario->nome }}
            <span class="pull-right-container">
                <a href="{{ route('usuarios.index') }}" class="btn btn-default btn-flat pull-right">
                    CANCELAR
                </a>
                {{ Form::button('<i class="fa fa-repeat"></i> ATUALIZAR', ['class' => 'btn btn-flat btn-success pull-right', 'name' => 'update-usuario', 'type' => 'submit']) }}
            </span>
        </h4>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-4 col-md-offset-4">
                <div class="form-group">
                    <label>Nome</label>
                    {{ Form::text('nome', $usuario->nome, ['class' => 'form-control', 'disabled']) }}
                </div>

                <div class="form-group">
                    <label>CPF</label>
                    {{ Form::text('cpf', $usuario->cpf, ['class' => 'form-control mask_cpf', 'disabled']) }}
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    {{ Form::text('email', $usuario->email, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label>Função</label>
                    {{ Form::select('funcao[]', $roles, array_keys($usuario->getRoles()), ['class' => 'form-control select2', 'required', 'multiple']) }}
                </div>

                <div class="form-group">
                    <a href="{{ route('tardis-update-password', $usuario->cpf) }}" class="btn btn-default btn-flat btn-block">Alterar Senha</a>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <h4 align="center">Permissões do usuário</h4><hr>

                @foreach($permissions as $permissao)
                    @php $can = $permissao->name; @endphp
                    <div class="col-md-4">
                        <label>
                            <table>
                                <tr> 
                                    <td> 
                                        <h4>&nbsp; {{ $permissao->name }} <br>
                                        <small style="font-weight: 100; color: #333; font-size: 11px;"> &nbsp; - {{ $permissao->description }} </small> </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="100" valign="top">
                                        @foreach($permissao->slug as $slug => $value)
                                            <button type="button" class="alter_slug btn btn-sm @if($usuario->can($slug . '.' . $permissao->name)) btn-success @else btn-default @endif" style="margin: 6px 2px;" data-slug="{{ $slug }}" data-permissao="{{ $permissao->name }}">
                                                {{ $slug }}
                                            </button>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{ Form::close() }}

    <div id="loader" class="overlay hide">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div> <!-- END div.box -->

@endsection