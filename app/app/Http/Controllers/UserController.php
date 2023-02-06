<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAvatar;
use App\Models\UserInfo;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if (request()->hasFile('avatar')) {
            $uploadedAvatar = request()->file('avatar');
            $path = $uploadedAvatar->store('avatars', ['disk' => 's3']);
            //var_dump($path, Storage::disk('s3')->files()); die;
            $avatar = $info->avatar_id ? UserAvatar::find($info->avatar_id) : new UserAvatar();
            $avatar->path = $path;
            $avatar->save();
            $info->avatar_id = $avatar->id;
        }

        $info->save();

        if (!$user->info_id) {
            $user = User::find($user->id);
            $user->info_id = $info->id;
            $user->save();
        }

        return response()->redirectTo('/users/profile');
    }
}
