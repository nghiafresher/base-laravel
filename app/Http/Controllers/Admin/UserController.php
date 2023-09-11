<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
    }

    public function create()
    {
        $routeForm = route('admin.user.store');
        $data = [
            'routeForm' => $routeForm
        ];
        return view('admin.user.create', $data);
    }

    public function store(UserStoreRequest $request)
    {
        $inputs = $request->all();
        dd($inputs);
    }
    public function edit()
    {
        return view('admin.user.edit');
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
