<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست کاربران';
        return view('admin.user.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد کاربر';
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $image = User::saveImage($request->file);
        User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'photo' => $image,
        ]);

        return to_route('users.index')->with('success', 'کاربر جدید با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'ویرایش کاربر';
        $user = User::query()->find($id);
        return view('admin.user.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, $id)
    {
        $user = User::query()->find($id);
        $image = User::saveImage($request->file);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $user->password,
            'mobile' => $request->input('mobile'),
            'photo' => $image,
        ]);

        return to_route('users.index')->with('success', 'کاربر جدید با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createUserRole($id)
    {
        $user = User::query()->find($id);
        $roles = Role::query()->get();
        return view('admin.user.user_roles', compact('user', 'roles'));
    }

    public function storeUserRole(Request $request, $id)
    {
        $user = User::query()->find($id);
        $user->syncRoles($request->roles);

        return to_route('users.index')->with('success', 'نقش کاربر با موفقیت ویرایش شد');
    }
}
