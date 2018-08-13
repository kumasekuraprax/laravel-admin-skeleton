<?php

namespace App\Entity;

use App\Exceptions\Exception;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioEntity
{
    /**
     * Create or update a User
     *
     * @return bollean
     */
    public function save($data, $action, $id = null)
    {
        try {
            DB::beginTransaction();

            $role = $data['funcao'];
            unset($data['funcao']);
            if ($action == 'create') {
                $usuario = Usuario::create($data);
            } else {
                $usuario = Usuario::findOrFail($id);
                $usuario->update($data);
            }

            $usuario->syncRoles($role);
            
            DB::commit();

            return ['status' => true, 'id' => $usuario->id];
        } catch (Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ];
        }
    }

    /**
     * Revoke all Permission / Roles and delete user
     *
     * @return bollean
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $usuario = Usuario::findOrFail($id);
            $usuario->revokeAllRoles();
            $usuario->delete();
            
            DB::commit();

            return ['status' => true];
        } catch (Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ];
        }
    }


    public function alterSlugUser($id, $permissao, $slug)
    {
        try {
            DB::beginTransaction();

            $alias = "$slug.$permissao";
            $usuario = Usuario::find($id);
            $permission = Permission::whereName($permissao)->first();

            /* Captura a permissao atual e monta o slug*/
            $permissao_user = $usuario->getPermissions();

            if (empty($permissao_user) || !isset($permissao_user[$permissao])) {
                $acao = $permission->slug;
            } else {
                $acao = $permissao_user[$permissao];
            }
            $acao[$slug] = $acao[$slug] == true ? false : true;

            /* Monta o array da permissao */
            $arr = [
                'name' => $permissao,
                'slug' => $acao,
                'inherit_id' => $permission->getKey(),
                'description' => $permission->description
            ];

            /* Remove a permissao atual */
            $usuario->removePermission($permissao);

            /* Verifica se a permissao atual existe */
            $new_permission = Permission::whereName($permissao)->whereSlug(json_encode($acao))->first();
            
            if (!$new_permission || $new_permission->count() == 0) {
                $new_permission = Permission::create($arr);
            }
            $usuario->assignPermission($new_permission->id);

            DB::commit();
            return ['status' => true];
        } catch (Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ];
        }
    }
}
