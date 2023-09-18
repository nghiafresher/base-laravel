<?php

namespace App\Http\Controllers\Admin;

use App\Services\RoleService;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public $userService;
    public $roleService;
    public function __construct(
        UserService $userService,
        RoleService $roleService
    ){
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    //
    public function index(Request $request)
    {
        $inputs = $request->all();
        $users = $this->userService->getListUser($inputs);
        $data = [
            'users' => $users
        ];
        return view('admin.user.index', $data);
    }

    /**
     * Create user
     *
     * @returns View
     */
    public function create()
    {
        $routeForm = route('admin.user.store');
        return view('admin.user.create', compact('routeForm'));
    }

    /**
     * Store user
     *
     * @param UserStoreRequest $request
     * @return void
     */
    public function store(UserStoreRequest $request)
    {
        $inputs = $request->all();
        $user = $this->userService->create($inputs);
        if($user) {
            return redirect()->route('admin.user.index')->with('message', 'Thêm user thành công');
        }
        return redirect()->back()->withInput()->with('error', 'Thêm user lỗi');
    }

    /**
     * Edit user
     *
     * @param $id
     * @return View
     */
    public function edit($id)
    {
        $user = $this->userService->find($id, ['roles']);
        if(!$user) {
            abort(404);
        }
        $routeForm = route('admin.user.update', $id);
        $roles = $this->roleService->list();
        $data = [
            'user' => $user,
            'routeForm' => $routeForm,
            'roles' => $roles
        ];

        return view('admin.user.edit', $data);
    }

    /**
     * Update user
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $inputs = $request->all();
        $user = $this->userService->updateUser($inputs, $id);
        if($user) {
            return redirect()->route('admin.user.index')->with('message', 'Cập nhật user thành công');
        }
        return redirect()->back()->withInput()->with('error', 'Cập nhật user lỗi');
    }
    public function delete()
    {
    }
}
