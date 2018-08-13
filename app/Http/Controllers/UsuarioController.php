<?php

namespace App\Http\Controllers;

use App\Entity\UsuarioEntity;
use App\Exceptions\Exception;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.usuarios.index', ['usuarios' => Usuario::all(), 'roles' => Role::pluck('name', 'id')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $usuarioEntity = new UsuarioEntity();
            $response = $usuarioEntity->save($request->all(), 'create');

            if ($response['status']) {
                return redirect()->route('usuarios.edit', $response['id'])->with('success', 'Perfil criado com sucesso!');
            } else {
                throw new Exception($response);
            }
        } catch (Exception $e) {
            report($e);
            return redirect()->route('usuarios.create')->with('danger', 'Não foi possivel criar o perfil!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.usuarios.edit', [
            'usuario' => Usuario::findOrFail($id),
            'permissions' => Permission::whereInheritId(null)->get(),
            'roles' => Role::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $usuarioEntity = new UsuarioEntity();
            $response = $usuarioEntity->save($request->all(), 'update', $id);

            if ($response['status']) {
                return redirect()->route('usuarios.edit', $id)->with('success', 'Perfil atualizado com sucesso!');
            } else {
                throw new Exception($response);
            }
        } catch (Exception $e) {
            report($e);
            return redirect()->route('usuarios.edit', $id)->with('danger', 'Não foi possivel atualizar o perfil!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $usuarioEntity = new UsuarioEntity();
            $response = $usuarioEntity->delete($id);

            if ($response['status']) {
                return redirect()->route('usuarios.index')->with('success', 'Perfil excluido com sucesso!');
            } else {
                throw new Exception($response);
            }
        } catch (Exception $e) {
            report($e);
            return redirect()->route('usuarios.create')->with('danger', 'Não foi possivel excluir o perfil!');
        }
    }


    /**
     * Alter Slug Permission to a User
     *
     * @return JSON Response
     */
    public function alterSlugUser($id, $permission, $slug)
    {
        try {
            $usuarioEntity = new UsuarioEntity();
            $response = $usuarioEntity->alterSlugRole($id, $permission, $slug);

            if ($response['status']) {
                return response()->json(['status' => true]);
            } else {
                throw new Exception($response);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage() . " " . $e->getFile() . " (" . $e->getLine() . ")"]);
        }
    }
}
