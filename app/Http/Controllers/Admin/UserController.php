<?php

namespace App\Http\Controllers\Admin;

use App\Business\UserBusiness;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userBusiness;
    public function __construct(UserBusiness $userBusiness)
    {
        $this->userBusiness = $userBusiness;
    }

    public function index()
    {
        $users = $this->userBusiness->getList([], [], DEFAULT_PER_PAGE);
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
        $user = $this->userBusiness->storeUser($inputs);
        if($user) {
            return redirect()->back()->with('message', 'Thêm user thành công');
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
        $user = $this->userBusiness->findById($id);
        if(!$user) {
            abort(404);
        }
        $routeForm = route('admin.user.update', $id);
        $data = [
            'user' => $user,
            'routeForm' => $routeForm
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
        $user = $this->userBusiness->updateUser($inputs, $id);
        if($user) {
            return redirect()->route('admin.user.index')->with('message', 'Cập nhật user thành công');
        }
        return redirect()->back()->withInput()->with('error', 'Cập nhật user lỗi');
    }
    public function delete()
    {
    }
}
