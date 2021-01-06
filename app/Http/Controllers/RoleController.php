<?php

namespace App\Http\Controllers;

use Exception;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Role/Index', [
            'roles' => Role::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Role/Create', [
            'permissions' => Permission::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validateWithBag('storeRole', [
            'name' => ['string','required','max:255','unique:roles,name'],
            'permissions' => ['array','nullable'],
            'permissions.*' => ['required','exists:permissions,id']
        ]);
        DB::beginTransaction();
        try
        {
            $role = Role::create(['name' => $request->name]);
            if(!is_null($request->permissions))
            {
                $role->syncPermissions($request->permissions);
            }
            DB::commit();
            return redirect()->route('admin.role.index');
        }
        catch(Exception $e)
        {
            DB::rollback();
            throw $e;

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return Inertia::render('Admin/Role/Edit', [
            'role' => [
                'data' => $role,
                'permissions' => $role->permissions()->pluck('id')
            ],
            'permissions' => Permission::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validateWithBag('storeRole', [
            'name' => ['string','required','max:255', Rule::unique('roles')->ignore($role->id)],
            'permissions' => ['array','nullable'],
            'permissions.*' => ['required','exists:permissions,id']
        ]);
        DB::beginTransaction();
        try
        {
            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);
            DB::commit();
            return redirect()->route('admin.role.index');
        }
        catch(Exception $e)
        {
            DB::rollback();
            throw $e;

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.role.index');
    }
}
