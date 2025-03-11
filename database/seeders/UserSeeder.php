<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // قراءة ملف JSON
        $json = File::get(database_path('seeders/user.json'));
        $users = json_decode($json, true);

        // إدراج البيانات في جدول users
        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
