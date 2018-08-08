<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AclController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.acl.index', ['roles' => Role::all(), 'permissions' => Permission::all()]);
    }

    /**
     * Show the details for Role
     *
     * @return \Illuminate\Http\Response
     */
    public function showRole($id)
    {
        return view('admin.acl.show-role', ['role' => Role::findOrFail($id), 'permissions' => Permission::whereInheritId(null)->get()]);
    }

    /**
     * Alter Slug Role
     *
     * @return JSON Response
     */
    public function alterSlugRole($id, $permission, $slug)
    {
        try {
            $aclEntity = new AclEntity();
            $response = $aclEntity->alterSlugRole($id, $permission, $slug);

            if ($response['status']) {
                return response()->json(['status' => true]);
            } else {
                throw new Exception($response);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage() . " " . $e->getFile() . " (" . $e->getLine() . ")"]);
        }
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
            $aclEntity = new AclEntity();
            $response = $aclEntity->save($request->all(), 'create');

            if ($response['status']) {
                return response()->json($response);
                // return redirect()->route('acl.edit', $response['id'])->with('success', ucfirst($request->type) . ' criado com sucesso!');
            } else {
                throw new Exception($response);
            }
        } catch (Exception $e) {
            report($e);

            return response()->json(['status' => false]);
            // return redirect()->route('acl.index')->with('danger', 'Não foi possivel criar a ' . ucfirst($request->type) . '!');
        }
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
            $aclEntity = new AclEntity();
            $response = $aclEntity->save($request->all(), 'update', $id);

            if ($response['status']) {
                return redirect()->route('acl.edit', $id)->with('success', ucfirst($request->type) . ' criado com sucesso!');
            } else {
                throw new Exception($response);
            }
        } catch (Exception $e) {
            report($e);
            return redirect()->route('acl.edit', $id)->with('danger', 'Não foi possivel criar a ' . ucfirst($request->type) . '!');
        }
    }
}
