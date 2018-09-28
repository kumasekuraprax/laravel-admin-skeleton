<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kodeine\Acl\Traits\HasRole;

class Usuario extends Authenticatable
{
    use Notifiable, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'cpf', 'ativo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /* @Override */
    public function removePermission($name)
    {
        $id = $this->getAttribute('id');
        $slugs = $this->permissions->keyBy('name');
        list($slug, $alias) = $this->extractAlias($name);

        /* Remove a referencia da permissao com o usuário */
        if ($slugs->has($alias) && is_null($slug)) {
            $permission_user = DB::delete('delete from permission_usuario where usuario_id = ? AND permission_id = ?', [$id, $slugs[$alias]->id]);
        }

        return true;
    }

    /* @Override */
    protected function extractAlias($str)
    {
        preg_match('/([^.].*)[\.]([^\s].*?)$/i', $str, $m);

        return [
            isset($m[1]) ? $m[1] : null, //slug
            isset($m[2]) ? $m[2] : $str, //alias
        ];
    }
}
