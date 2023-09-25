<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Dony Shawn',
            'nim' => '32101991',
            'email' => 'dony@gmail.com',
            'role_id' => 1,
            'prodi_id' => 1,
            'password' => Hash::make('123456'),
        ]);
    }
}
