<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->delete();

        $admin = new Admin;
        $admin->first_name = 'super';
        $admin->last_name = 'admin';
        $admin->email = 'superadmin@gmail.com';
        $admin->phone = '01010101010';
        $admin->address = 'Earth Country , Sky Street';
        $admin->password = bcrypt('123456');
        $admin->last_login_date = '-----';
        $admin->last_logout_date = '-----';
        $admin->save();
    }
}
