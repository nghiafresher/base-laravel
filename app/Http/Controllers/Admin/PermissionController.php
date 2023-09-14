<?php

namespace App\Http\Controllers\Admin;

use App\Business\PermissionBusiness;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    protected $permissionBusiness;
    public function __construct(PermissionBusiness $permissionBusiness)
    {
        $this->permissionBusiness = $permissionBusiness;
    }

    public function index(Request $request)
    {
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
        return view('admin.permission.create', compact('routeForm'));
    }

    /**
     * Store user
     *
     * @return void
     */
    public function store()
    {
    }

    /**
     * Edit user
     *
     * @param $id
     * @return View
     */
    public function edit($id)
    {
        $permission = $this->permissionBusiness->findById($id);
        if(!$permission) {
            abort(404);
        }
        $routeForm = route('admin.permission.update', $id);
        return view('admin.permission.edit', compact('routeForm', 'permission'));
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
