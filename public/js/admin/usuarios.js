$(document).ready(function() {
	
    trigger = {
        alterSlugUser(id, permissao, slug) {
            $.get('/admin/usuarios/' + id + '/alter-permission/' + permissao + '/slug/' + slug, function (response) {
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

    /* Permissões do usuário */
    $('button.alter_slug').click(function () {
        slug = $(this).data('slug');
        permissao = $(this).data('permissao');
        user_id = $('input[name=id]').val();

        trigger.alterSlugUser(user_id, permissao, slug);
    });


    /* init DataTable */
    $('#lista_usuarios').DataTable({
        language: {
            search:     "",
            processing: "Carregando conteúdo",
            info:       "Exibindo _START_ até _END_ de _TOTAL_ registros",
            infoEmpty:  "Nenhum registro existente",
            paginate: {
                first:      "&laquo;",
                last:       "&raquo;"
            },
            lengthMenu: "Mostrar _MENU_ registros"
        },
        "ordering": true,
        "columns": [
            { "data": "id" },
            { "data": "nome" },
            { "data": "email" },
            { "data": "roles" },
            { "data": "acoes" }
        ],
        "columnDefs": [
            { 
                orderable: false
            }
        ],
        pagingType: "first_last_numbers"
    });
});