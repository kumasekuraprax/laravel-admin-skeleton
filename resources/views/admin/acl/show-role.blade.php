@extends('page')

@section('title')
Admin - Editar Função {{ $role->name }}
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
        <li> <a href="{{ route('acl.index') }}"> ACL </a></li> 
        <li class="active">Editando {{ $role->name }}</li>
      </ol>
  </h1>
@stop

@section('content')
<div class="box box-success">
    
    {{ Form::open(['url' => null, 'method' => 'put', 'id' => 'atualiza_funcao']) }}
        {{ Form::hidden('acl_id', $role->id) }}

        <div class="box-header with-border">
            <h4>
                Editando Função | {{ $data['role']->name }}
                <span class="pull-right-container">
                    <a href="{{ route('acl.index') }}" class="btn btn-default btn-flat pull-right">
                        CANCELAR
                    </a>
                    {{ Form::button('<i class="fa fa-repeat"></i> ATUALIZAR', ['class' => 'btn btn-flat btn-success pull-right', 'name' => 'update-funcao', 'type' => 'submit']) }}
                </span>
            </h4>
            <span id="MessageUpdate"></span>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="form-group">
                        <label>Nome</label>
                        {{ Form::text('permissao', $role->name, ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>

                <div class="col-md-8 col-md-offset-2">
                    <h4 align="center">Permissões da Função</h4><hr>

                    @foreach($permissions as $permissao)
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
                                                <button type="button" class="alter_role_slug btn btn-sm @if($role->can($slug . '.' . $permissao->name)) btn-success @else btn-default @endif" style="margin: 6px 2px;" data-slug="{{ $slug }}" data-permissao="{{ $permissao->name }}">
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
</div> <!-- END div.box -->

@endsection