@extends('adminlte::page')

@section('title')
Admin - ACL (Controle de Acessos)
@stop

@section('css')
<!-- CSS especifico da view -->
@stop

@section('js')
<!-- JS especifico da view -->
<script type="text/javascript" src="{{ asset('js/admin/acl.js') }}"></script>
@stop

@section('content_header')
    <h1 style="height: 31px;"> 
      <ol class="breadcrumb" style="font-size: 11px;">
        <li> <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> </a> </li>
        <li>Controles</li>
        <li class="active">ACL</li>
      </ol>
  </h1>
@stop

@section('content')
{{ Form::hidden('_token', csrf_token()) }}
<div class="box box-warning">
    <div class="nav-tabs-custom" style="margin-top: 20px;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs" style="cursor: move;">
            <li class="pull-left header"><i class="fa fa-dashboard"></i> Overview - ACL</li>
            <li class="active">
                <a href="#roles" data-toggle="tab" aria-expanded="true">
                    Funções
                </a>
            </li>
            <li>
                <a href="#permissions" data-toggle="tab" aria-expanded="true">
                    Permissões
                </a>
            </li>
            <li class="pull-right">
                <button id="btn-nova-validacao" class="btn btn-default btn-flat pull-right" data-toggle="modal" data-target=".modal-permissao">
                    <i class="fa fa-plus"></i> Nova Permissão
                </button>

                <button id="btn-nova-validacao" class="btn btn-default btn-flat pull-right" data-toggle="modal" data-target=".nova-funcao" style="margin-right: 10px;">
                    <i class="fa fa-plus"></i> Nova Função
                </button>
            </li>
        </ul>

        <div class="tab-content no-padding">
            <div class="tab-pane active" id="roles" style="position: relative; min-height: 300px;">
                <div class="box-body">
                    @include('admin.acl.layouts._listaFuncoes')
                </div>
            </div>

            <div class="tab-pane" id="permissions" style="position: relative; min-height: 300px;">
                <div class="box-body">
                    @include('admin.acl.layouts._listaPermissoes')
                </div>
            </div>
            
            <div class="clearblock"></div>
        </div>
    </div>
</div> <!-- END div.box -->

<div class="modal fade nova-funcao" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header with-border">
                <h4> CADASTRO DE NOVA FUNÇÃO
                    <span class="pull-right-container">
                        <button data-dismiss="modal" aria-label="Fechar" class="close pull-right">
                            &times;
                        </a>
                    </span>
                </h4>
            </div>

            <div class="modal-body">
                <div class="col-md-6">
                    <label><b>Função *</b></label>
                    {{ Form::text('funcao', null, ['class' => 'form-control']) }}
                </div>

                <div class="col-md-6">
                    <label><b>alias *</b></label>
                    {{ Form::text('slug', null, ['class' => 'form-control']) }}
                </div>

                <div class="col-md-12">
                    <br><label><b>Descrição</b></label>
                    {{ Form::text('description', null, ['class' => 'form-control']) }}
                </div>

                <div class="clearblock"></div>
            </div>

            <div class="modal-footer">
                <span class="pull-right">
                    {{ Form::button('SALVAR', ['class' => 'btn btn-sm btn-success btn-flat save_funcao']) }}
                </span>
            </div>
        </div>
    </div>
</div> <!-- FIM MODAL NOVO-USUÁRIO -->

<div class="modal fade modal-permissao" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header with-border">
                <h4> CADASTRO DE NOVA PERMISSÃO
                    <span class="pull-right-container">
                        <button data-dismiss="modal" aria-label="Fechar" class="close pull-right">
                            &times;
                        </a>
                    </span>
                </h4>
            </div>

            <div class="modal-body">
                <div class="col-md-6">
                    <label><b>Permissão *</b></label>
                    {{ Form::text('permissao', null, ['class' => 'form-control']) }}
                </div>

                <div class="col-md-12">
                    <br><label><b>Descrição</b></label>
                    {{ Form::text('description', null, ['class' => 'form-control']) }}
                    <hr>
                </div>

                <div class="col-md-3">
                    <br><label><b>Ações</b></label>
                    {{ Form::text('acao_1', 'view', ['class' => 'form-control acoes']) }}
                </div>
                <span class="more_actions"></span>
                <div class="col-md-1">
                    <br><label>&nbsp;</label>
                    {{ Form::button('<i class="fa fa-plus"></i>', ['class' => 'btn btn-flat btn-primary add_acao']) }}
                </div>

                <div class="clearblock"></div>
            </div>

            <div class="modal-footer">
                <span class="pull-right">
                    {{ Form::button('SALVAR', ['class' => 'btn btn-sm btn-success btn-flat save_permissao']) }}
                </span>
            </div>
        </div>
    </div>
</div> <!-- FIM MODAL NOVO-USUÁRIO -->
@endsection