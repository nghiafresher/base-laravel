<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleStoreRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    protected $roleService;
    protected $permissionService;
    public function __construct(
        RoleService $roleService,
        PermissionService $permissionService
    ){
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Get list role
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $roles = $this->roleService->getListData($inputs);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Create user
     *
     * @returns View
     */
    public function create()
    {
        $routeForm = route('admin.role.store');
        $permissions = $this->permissionService->getGroupPermissionData();
        $data = [
            'routeForm' => $routeForm,
            'permissions' => $permissions
        ];

        return view('admin.role.create', $data);
    }

    /**
     * Store user
     *
     * @return void
     */
    public function store(RoleStoreRequest $request)
    {
        try {
            $inputs = $request->all();
            $permission = $this->roleService->storeRole($inputs);
            if($permission) {
                return redirect()->route('admin.role.index')->with('message', 'Thêm vai trò thành công');
            }

        } catch (\Exception $e) {
            \Log::error($e);
        }
        return redirect()->back()->withInput()->with('error', 'Thêm vai trò lỗi');
    }

    /**
     * Edit user
     *
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $role = $this->roleService->find($id, ['permissions']);
        if(!$role) {
            abort(404);
        }
        $permissions = $this->permissionService->getGroupPermissionData();
        $routeForm = route('admin.role.update', $id);
        return view('admin.role.edit', compact('routeForm', 'permissions', 'role'));
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        try {
            $inputs = $request->all();
            $role = $this->roleService->find($id, ['permissions']);
            if($role) {
                $this->roleService->updateRole($role, $inputs);
                return redirect()->route('admin.role.index')->with('message', 'Cập nhật vai trò thành công');
            }

        } catch (\Exception $e) {
            \Log::error($e);
        }
        return redirect()->back()->withInput()->with('error', 'Cập nhật vai trò lỗi');
    }

    public function delete()
    {
    }

}
