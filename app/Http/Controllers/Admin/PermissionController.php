<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\User;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\PermissionStoreRequest;
use App\Http\Requests\Admin\Permission\PermissionUpdateRequest;
use App\Models\BaseModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    protected $permissionBusiness;
    protected $models;
    public function __construct(PermissionService $permissionBusiness)
    {
        $this->permissionBusiness = $permissionBusiness;
        $this->models = BaseModel::getModels();
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Permission::class);
        $inputs = $request->all();
        $permissions = $this->permissionBusiness->getListData($inputs);
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Create user
     *
     * @returns View
     */
    public function create()
    {
        $routeForm = route('admin.permission.store');
        $models = $this->models;
        return view('admin.permission.create', compact('routeForm','models'));
    }

    /**
     * Store user
     *
     * @return void
     */
    public function store(PermissionStoreRequest $request)
    {
        try {
            $inputs = $request->all();
            $permission = $this->permissionBusiness->create($inputs);
            if($permission) {
                return redirect()->route('admin.permission.index')->with('message', 'Thêm quyền thành công');
            }

        } catch (\Exception $e) {
            \Log::error($e);
        }
        return redirect()->back()->withInput()->with('error', 'Thêm quyền lỗi');
    }

    /**
     * Edit user
     *
     * @param $id
     * @return View
     */
    public function edit(Permission $permission)
    {
//        $this->authorize('update', $permission);
        $models = $this->models;
        if(!$permission) {
            abort(404);
        }
        $routeForm = route('admin.permission.update', $permission->id);
        return view('admin.permission.edit', compact('routeForm', 'permission', 'models'));
    }

    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        try {
            $inputs = $request->all();
            if($permission) {
                $this->permissionBusiness->update($permission, [
                    'model_name' => $inputs['model_name'],
                    'description' => $inputs['description'],
                ]);
                return redirect()->route('admin.permission.index')->with('message', 'Cập nhật quyền thành công');
            }
        } catch (\Exception $e) {
            \Log::error($e);
        }
        return redirect()->back()->withInput()->with('error', 'Cập nhật quyền lỗi');
    }

    public function delete()
    {
    }
}
