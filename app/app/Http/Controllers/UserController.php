<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::with(['role', 'info', 'info.avatar'])
            ->where('name', '<>', User::USER_SUPERADMIN)
            ->get();
        return view('admin.users', ['users' => $users]);
    }

    public function delete() {
        $request = request()->request->all();
        $user = User::find($request['id']);
        $user->delete();
        return response()->redirectTo('/users');
    }

    public function setAdmin() {
        $request = request()->request->all();
        $user = User::find($request['id']);
        $user->role_id = UserRole::ROLE_ADMIN;
        $user->save();
        return response()->redirectTo('/users');
    }

    public function profile() {
        return view('user.profile', [
            'info' => auth()->user()->info ? UserInfo::find(auth()->user()->info_id) : new UserInfo(),
        ]);
    }

    public function editProfile() {
        $user = auth()->user();
        $info = $user->info ? UserInfo::find($user->info_id) : new UserInfo();
        $data = request()->request->all();
        $info->fill($data);
        $info->save();

        if (!$user->info_id) {
            $user = User::find($user->id);
            $user->info_id = $info->id;
            $user->save();
        }

        return response()->redirectTo('/users/profile');
    }
}
