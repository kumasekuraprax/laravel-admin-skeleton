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
}
