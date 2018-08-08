@extends('page')

@section('title')
Admin - Usuários
@stop

@section('css')
<!-- CSS especifico da view -->
@stop

@section('js')
<script type="text/javascript" src="{{ asset('js/admin/usuarios.js') }}"></script>
@stop

@section('content_header')
    <h1 style="height: 31px;"> 
      <ol class="breadcrumb" style="font-size: 11px;">
        <li> <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> </a> </li>
        <li>Controles</li>
        <li class="active">Usuários</li>
      </ol>
  </h1>
@stop

@section('content')
<div class="box box-warning">
    <div class="box-header with-border">
        <h4>
            Usuários
            <span class="pull-right-container">
                <button id="btn-novo-usuario" class="btn btn-default btn-flat pull-right" data-toggle="modal" data-target=".novo-usuario">
                    <i class="fa fa-plus"></i> Novo Usuário
                </button>
            </span>
        </h4>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table no-margin" id="lista_usuarios">
                        <thead>
                            <tr>
                                <td><b>#</b></td>
                                <td><b>Nome</b></td>
                                <td><b>E-mail</b></td>
                                <td><b>Função Usuário</b></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $user)
                                <tr>
                                    <td style="width: 4%;"> {{ $user->id }} </td>
                                    <td style="width: 16%;"> {{ $user->nome }} </td>
                                    <td  style="width: 20%;"> {{ $user->email }} </td>
                                    <td> 
                                        @foreach($user->getRoles() as $role) 
                                            <label class="label label-default"> {{ ucfirst($role) }} </label>
                                        @endforeach
                                    </td>
                                    <td style="width: 10%;">
                                        <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-sm btn-flat btn-block btn-primary">
                                            <i class="fa fa-edit"></i> EDITAR
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-12">
                <ul id="paginate" class="pagination"></ul>
            </div>
        </div>
    </div>

    <div id="loader" class="overlay hide">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div> <!-- END div.box -->

<div class="modal fade novo-usuario" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <h4> CADASTRO DE NOVO USUÁRIO
                    <span class="pull-right-container">
                        <button data-dismiss="modal" aria-label="Fechar" class="close pull-right">
                            &times;
                        </a>
                    </span>
                </h4>
                    <button id="btn-panel-dados-fornecedor" class="btn-valida label-info">
                        <span class="fa fa-id-card"></span>
                        DADOS USUÁRIO
                    </button>
                    <div id="panel-dados-fornecedor" class="panel-dados">
                        <div class="row">
                            {{ Form::open(['route' => 'usuarios.store', 'method' => 'POST', 'id' => 'envia-novo-usuario']) }}
                                <div id="form-style" class="form-group">
                                    <div class="col-md-6">
                                        <label>Nome do Usuário <span id="msg" class="label"></span></label><br>
                                        {{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Insira o nome', 'required']) }}
                                    </div>

                                    <div class="col-md-6">
                                        <label>CPF do Usuário <span id="msg" class="label"></span></label><br>
                                        {{ Form::text('cpf', null, ['class' => 'form-control mask_cpf', 'placeholder' => '000.000.000-00', 'required']) }}
                                    </div>

                                    <div id="hider" class="col-md-6">
                                        <label>E-mail</label> <br>
                                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Insira o email', 'required']) }}
                                    </div>

                                    <div class="col-md-6">
                                        <label>Tipo de Usuário</label> <br>
                                        {{ Form::select('permissao', $roles, null, ['class' => 'form-control', 'id' => 'permissao']) }}
                                    </div>

                                    <div class="col-md-12 hide" id="box-permissao"></div>
                                    
                                    <div class="clearblock"></div>
                                    <div class="col-md-3">
                                        <br><br>
                                        {{ Form::button('Incluir', ['class' => 'btn btn-block btn-success btn-flat', 'type' => 'submit']) }}
                                        <span id="MessageForm"></span>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="clearblock"></div>
                    </div>
                </div>

                <div class="clearblock"></div>
            </div>

        </div>
    </div>
</div> <!-- FIM MODAL NOVO-USUÁRIO -->


<div class="modal fade deletar-usuario" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <h3 class="text-red"> REMOVER USUÁRIO | <span id="info_nome"></span>
                    <span class="pull-right-container">
                        <button data-dismiss="modal" aria-label="Fechar" class="close pull-right">
                            &times;
                        </button>
                    </span>
                </h3>
                <p> Deseja realmente remover este usuário da lista, impedindo seu acesso ao Portal?</p>
                <span id="MessageDelete"></span>

                <span class="pull-right-container">
                    {{ Form::open(['url' => null, 'method' => 'delete', 'id' => 'deletar_usuario']) }}
                        {{ Form::hidden('del_user') }}
                        {{ Form::button('EXCLUIR', ['name' => 'deletar', 'class' => 'btn btn-flat btn-danger pull-right', 'type' => 'submit']) }}
                        {{ Form::button('CANCELAR', ['data-dismiss' => 'modal', 'aria-label' => 'Fechar', 'class' => 'btn btn-flat btn-default pull-right', 'type' => 'button']) }}
                    {{ Form::close() }}
                </span>

                <div class="clearblock"></div>
            </div>

        </div>
    </div>
</div> <!-- FIM MODAL CONSULTA-FORNECEDOR -->
@endsection