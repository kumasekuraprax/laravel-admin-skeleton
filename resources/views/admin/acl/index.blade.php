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

<div class="box box-solid">
    <div class="nav-tabs-custom">
        <div class="box-body">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <h5> <i class="fa fa-book"></i> COMO UTILIZAR O RECURSO DE <b>FUNÇÕES</b> DO ACL </h5> <hr />

                <label> <small>Verificando se o usuario possui uma ou varias funções atreladas</small> </label>
                <pre><em><b>EM CONTROLLER / SERVICES / REPOSITORY / ETC</b></em> <br /><br />Auth::user()->hasRole('admin') <br />Auth::user()->hasRole('admin|comercial|financeiro')</pre>

                <br /> <hr />

                <pre><em><b>BLADE</b></em> <br /><br />_@role('admin') [... html .. ] _@endrole<br />_@role('admin|comercial|financeiro') [... html ...] _@endrole</pre>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6">
                <h5> <i class="fa fa-book"></i> COMO UTILIZAR O RECURSO DE <b>PERMISSÕES</b> DO ACL </h5> <hr />

                <label> <small>Verificando se o usuario possui uma ou varias permissões</small> </label>
                <pre><em><b>EM CONTROLLER / SERVICES / REPOSITORY / ETC</b></em> <br /><br />Auth::user()->can('create.usuarios') <br />Auth::user()->can('create.usuarios|update.usuarios')</pre>

                <br /> <hr />

                <pre><em><b>BLADE</b></em> <br /><br />_@permission('create.usuarios') [... html ...] _@endpermission <br />_@permission('create.usuarios|update.usuarios') [... html ...] _@endpermission</pre>
            </div>
        </div>
    </div>
</div>
<div class="clearblock"></div>

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