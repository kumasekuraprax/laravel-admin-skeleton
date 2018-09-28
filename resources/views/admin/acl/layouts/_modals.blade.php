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
                    {{ Form::text('slug', null, ['class' => 'form-control lowerlabel']) }}
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
                    {{ Form::text('permissao', null, ['class' => 'form-control lowerlabel']) }}
                </div>

                <div class="col-md-12">
                    <br><label><b>Descrição</b></label>
                    {{ Form::text('description', null, ['class' => 'form-control']) }}
                    <hr>
                </div>

                <div class="col-md-3">
                    <br><label><b>Ações</b></label>
                    {{ Form::text('acao_1', 'view', ['class' => 'form-control acoes lowerlabel']) }}
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