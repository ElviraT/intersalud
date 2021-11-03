<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Flash;

class RolController extends Controller
{
     public function __construct()
    {
      $this->middleware('can:rol')->only('index');
      $this->middleware('can:rol.add')->only('add');
      $this->middleware('can:rol.edit')->only('edit');
      $this->middleware('can:rol.destroy')->only('destroy');
    }
    public function index()
    {    
        $roles = Role::all();	
    	return view('admin.configuracion.roles.index', compact('roles'));
    }

    public function create()
    {
        $permisos= Permission::all();

        return view('admin.configuracion.roles.create', ['permisos' => $permisos]);
    }

    public function add(Request $request)
    {
    	$role= Role::create($request->all());
    	$role->permissions()->sync($request->permissions);

    	Flash::success("Registro Agregado Correctamente");

    	return redirect()->route('rol');
    }

    public function edit(Role $role)
    {
        $permisos= Permission::all();

        return view('admin.configuracion.roles.edit', compact('role','permisos'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        Flash::success("Registro Actualizado Correctamente");

        return redirect()->route('rol');
    }

    public function destroy(Request $request)
    {
    	$id = (int)$request->input('id');
        $rol= Role::where('id', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('rol');
    }
}
