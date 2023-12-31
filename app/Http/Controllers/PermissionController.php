<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:permiso index')->only('index');
        $this->middleware('can:permiso create')->only('create','store');
        $this->middleware('can:permiso update')->only('edit','update');
        $this->middleware('can:permiso delete')->only('destroy');
    }
    
    public function index(): Response
    {
        return Inertia::render('admin/permisos/Index', [
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('admin/permisos/Create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePermissionRequest $request): RedirectResponse
    {
        Permission::create($request->validated());
        return to_route('admin.permissions.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): Response
    {
        return Inertia::render('admin/permisos/Edit', [
            'permission' => new PermissionResource($permission)
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        return to_route('admin.permissions.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return back();
    }
}
