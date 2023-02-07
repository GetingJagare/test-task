<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAvatar;
use App\Models\UserInfo;
use App\Models\UserRole;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'info'])
            ->where('name', '<>', User::USER_SUPERADMIN)
            ->get();

        return view('admin.users', ['users' => $users]);
    }

    public function delete()
    {
        $request = request()->request->all();
        $user = User::find($request['id']);
        $user->delete();

        return response()->redirectTo('/users');
    }

    public function setAdmin()
    {
        $request = request()->request->all();
        $user = User::find($request['id']);
        $user->role_id = UserRole::ROLE_ADMIN;
        $user->save();

        return response()->redirectTo('/users');
    }

    public function profile()
    {
        return view('user.profile', [
            'info' => auth()->user()->info ? UserInfo::find(auth()->user()->info_id) : new UserInfo(),
        ]);
    }

    public function editProfile()
    {
        $user = User::with(['info', 'info.avatar'])->find(auth()->user()->id);
        $info = $user->info ? UserInfo::find($user->info_id) : new UserInfo();
        $data = request()->request->all();
        $info->fill($data);

        if (request()->hasFile('avatar')) {
            $uploadedAvatar = request()->file('avatar');
            $path = $uploadedAvatar->store('', ['disk' => 'avatars']);
            $avatar = $info->avatar ? UserAvatar::find($info->avatar_id) : new UserAvatar();
            if ($avatar->path && Storage::disk('avatars')->exists($avatar->path)) {
                Storage::disk('avatars')->delete($avatar->path);
            }
            $avatar->path = $path;
            $avatar->save();
            $info->avatar_id = $avatar->id;
        }

        $info->save();
        $user->info_id = $info->id;
        $user->save();

        return response()->redirectTo('/users/profile');
    }

    public function avatar()
    {
        $user = User::with(['info', 'info.avatar'])->find(auth()->user()->id);
        $path = "";

        if ($user->info && $user->info->avatar) {
            $avatar = Storage::disk('avatars')->get($user->info->avatar->path);
            if ($avatar) {
                preg_match("/\.(.+)$/", $user->info->avatar->path, $matches);
                $ext = $matches[1];
                $tmpPath = "avatars/" . sha1(auth()->user()->id) . "." . $ext;
                $path = Storage::disk('images')->put($tmpPath, $avatar) ? "/images/$tmpPath" : $path;
            }
        }

        return response()->json(['path' => $path]);
    }
}
