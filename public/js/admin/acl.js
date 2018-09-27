$(document).ready(function() {
    
    trigger = {
        saveAcl: function(data) { 
            $.post('/admin/acl', data, function (response) {
                if (response.status) {
                    swal({
                        text: 'Ação realizada com sucesso!',
                        icon: 'success'
                    });

                    setTimeout(function () {
                        location.reload(true);
                    }, 2000);
                } else {
                    swal({
                        text: 'Não foi possivel realizar a ação!',
                        icon: 'error'
                    });
                }
            });
        },

        updateAcl: function(data) {
            $.ajax({
                type: 'PUT',
                url: '/admin/acl/' + data.acl_id,
                data: data,
                success: function (response) {
                    if (response.status) {
                        swal({
                            text: 'Ação realizada com sucesso!',
                            icon: 'success'
                        });
                    } else {
                        swal({
                            text: 'Não foi possivel realizar a ação!',
                            icon: 'error'
                        });
                    }
                }
            });
        },

        alterSlugRole(id, permissao, slug) {
            $.get('/admin/acl/role/' + id + '/alter-permission/' + permissao + '/slug/' + slug, function (response) {
                if (response.status) {
                    location.reload(false);
                } else {
                    swal({
                        text: response.message,
                        icon: 'error',
                        timer: 3000,
                        buttons: false
                    });
                }
            });
        }
    }

    /* Salvar uma Função (new or update) */
    $('.save_funcao').click(function () {
        data = {
            _token: $('input[name=_token]').val(),
            type: 'role',
            name: $('input[name=funcao]').val(),
            slug: $('input[name=slug]').val(),
            description: $('input[name=description]').val(),
        }

        $(this).html('<i class="fa fa-spin fa-spinner"></i> SALVANDO...');

        trigger.saveAcl(data);
    });

    $('.update_funcao').click(function () {
        data = {
            _token: $('input[name=_token]').val(),
            type: 'role',
            acl_id: $('input[name=acl_id]').val(),
            name: $('input[name=funcao]').val(),
            slug: $('input[name=slug]').val(),
            description: $('input[name=description]').val(),
        }

        $(this).html('<i class="fa fa-spin fa-spinner"></i> SALVANDO...');

        trigger.updateAcl(data);
    });


    $('.add_acao').click(function () {
        qntAcoes = $('input.acoes').length + 1;
        html = '<div class="col-md-3">'
             + '<br><label>&nbsp;</label>'
             + '<input name="acao_' + qntAcoes + '" type="text" class="form-control acoes">'
             + '</div>';

        $('.more_actions').append(html);
    });

    /* Salvar uma Permissão (new or update) */
    $('.save_permissao').click(function () {
        slugs = {};

        i = 1;

        do {
            slugs[$('input[name=acao_' + i + ']').val()] = true;
        } while (typeof($('input[name=acao_' + ++i + ']').val()) != 'undefined');

        data = {
            _token: $('input[name=_token]').val(),
            type: 'permission',
            name: $('.modal-permissao input[name=permissao]').val(),
            slug: slugs,
            description: $('.modal-permissao input[name=description]').val(),
        }

        $(this).html('<i class="fa fa-spin fa-spinner"></i> SALVANDO...');

        trigger.saveAcl(data);
    });


    /* Alterar permissao em uma Role */
    $('button.alter_role_slug').click(function () {
        slug = $(this).data('slug');
        permissao = $(this).data('permissao');
        role_id = $('input[name=acl_id]').val();

        trigger.alterSlugRole(role_id, permissao, slug);
    });
});