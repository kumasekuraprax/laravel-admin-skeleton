<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/login', function () {
    return redirect('/');
})->name('login');

/**
 *----------------------------------
 *  Rotas padrões para Tardis
 *----------------------------------
 * [ / ] Rota inicial que redireciona para o sistema da Tardis para realizar a autenticação no Portal
 * [ /access ] Rota de retorno, após autenticação na Tardis
 */
Route::get('/', function () {
    return redirect(config('app.tardis_url') . "login/" . config('app.tardis_request'));
});

Route::prefix('tardis')->group(function () {
    Route::post('valida', 'Access\TardisController@valida');
    Route::get('usuarios/{cpf}/update-password', 'Access\TardisController@updatePassword')->name('tardis-update-password');
});


Route::middleware(['auth', 'debugger'])->group(function () {

    /**
     *----------------------------------
     *  Rotas Dashboard
     *----------------------------------
     * [ /dashboard ] Rota principal após o login já realizado
     */
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    /**
     *----------------------------------
     *  Rotas Admin
     *----------------------------------
     * [ GET /admin/{route_name} ] Listagem de Usuarios padrões
     * [ GET /admin/{route_name}/create ] View para criar um novo usuário
     * [ GET /admin/{route_name}/{id}/edit ] View para editar um usuário existente
     * [ POST /admin/{route_name} ] Grava um novo usuario no Banco
     * [ PUT /admin/{route_name}/{id} ] Atualiza um usuário no Banco
     * [ DELETE /admin/{route_name}/{id} ] Apaga um usuário no Banco
     */
    Route::prefix('admin')->group(function () {
        /* Extras for ACL */
        Route::get('acl/role/{id}/show', 'AclController@showRole')->name('acl.show-role');
        Route::get('acl/role/{id}/alter-permission/{permission}/slug/{slug}', 'AclController@alterSlugRole');

        /* Extras for Usuarios */
        Route::get('usuarios/{id}/alter-permission/{permission}/slug/{slug}', 'UsuarioController@alterSlugUser');

        Route::resources([
            'usuarios' => 'UsuarioController',
            'acl' => 'AclController',
        ]);
    });
});
