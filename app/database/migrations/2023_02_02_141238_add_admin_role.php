<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $adminRoleId = DB::table('user_roles')->select('id')->where('alias', 'admin')->first();
        DB::table('users')->where('name', 'admin')->update(['role_id' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('name', 'admin')->update(['role_id' => 0]);
    }
};
