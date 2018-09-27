@extends('page')

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

@include('admin.acl.layouts._modals')

@endsection