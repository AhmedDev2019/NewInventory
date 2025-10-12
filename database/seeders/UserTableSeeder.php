<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();

        $user = new User;
        $user->name = 'user one';
        $user->email = 'userone@gmail.com';
        $user->phone = '01010101010';
        $user->status = 1;
        $user->address = 'Earth Country , Sky Street';
        $user->password = bcrypt('123456');
        $user->last_login_date = '-----';
        $user->last_logout_date = '-----';
        $user->save();
    }
}
