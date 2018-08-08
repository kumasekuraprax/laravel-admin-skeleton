<?php

namespace App\Entity;

use App\Exceptions\Exception;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AclEntity
{
    /**
     * Create or update a User
     *
     * @return bollean
     */
    public function save($data, $action)
    {
        try {
            DB::beginTransaction();

            $type = $data['type'];
            unset($data['type']);

            if ($action == 'create') {
                if ($type == 'role') {
                    $acl = Role::create($data);
                } else {
                    $slugs = [];
                    foreach ($data['slug'] as $k => $v) {
                        $slugs[$k] = true;
                    }
                    $data['slug'] = $slugs;
                    $acl = Permission::create($data);
                }
            } else {
                $id = $data['acl_id'];
                unset($data['acl_id']);

                if ($type == 'função') {
                    $role = Role::where('id', $id)->update($data);
                } else {
                    $slugs = [];
                    foreach ($data['slug'] as $k => $v) {
                        $slugs[$k] = true;
                    }
                    $data['slug'] = $slugs;

                    $permissao = Permission::where('id', $id)->update($data);
                }
            }
            
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

    public function alterSlugRole($id, $permission, $slug)
    {
        try {
            DB::beginTransaction();

            $alias = "$slug.$permissao";
            $role = Role::find($id);
            $permission = Permission::whereName($permissao)->first();

            /* Captura a permissao atual e monta o slug*/
            $permissao_role = $role->getPermissions();

            if (empty($permissao_role) || !isset($permissao_role[$permissao])) {
                $acao = $permission->slug;
            } else {
                $acao = $permissao_role[$permissao];
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
            $role->removePermission($permissao);

            /* Verifica se a permissao atual existe */
            $new_permission = Permission::whereName($permissao)->whereSlug(json_encode($acao))->first();
            
            if (!$new_permission || $new_permission->count() == 0) {
                $new_permission = Permission::create($arr);
            }
            $role->assignPermission($new_permission->id);

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
