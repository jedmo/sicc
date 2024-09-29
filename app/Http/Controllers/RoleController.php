<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate('10');

        return view('modules.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        $role = new Role;
        $role_permissions = [];

        return view('modules.roles.create', compact('role','permissions','role_permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();
        
        $role = Role::create(Arr::only($validated, ['name']));
        $role->syncPermissions(Arr::only($validated, ['permissions']));

        return redirect()->route('roles.index')->with('success','El rol ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role_permissions = Permission::join('role_has_permissions','permissions.id','=','role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $role->id)
            ->get();

        return view('modules.roles.show', compact('role','role_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $role_permissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)
        ->pluck('permission_id')->all();

        return view('modules.roles.edit', compact('role', 'permissions', 'role_permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();

        $role->name = $validated['name'];
        $role->save();

        if($role->name === 'Admin') {
            $role->syncPermissions(Permission::all());
        } else {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('roles.index')->with('success', 'El rol ha sido actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'El rol ha sido eliminado exitosamente.');
    }
}
