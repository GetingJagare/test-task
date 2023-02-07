<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! User::where(['name' => env('ADMIN_NAME')])->first()) {
            $user = User::create([
                'name' => env('ADMIN_NAME'),
                'email' => env('ADMIN_EMAIL'),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'role_id' => UserRole::ROLE_ADMIN,
            ]);
            $user->email_verified_at = Carbon::now();
            $user->save();
        }
    }
}
