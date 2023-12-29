<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
        'name'=>'admin',
        'email'=>'admin@email.com',
        'password'=>Hash::make('12345678'),
        'phone'=>'6285157934481',
        'role'=>'Admin'
    ]);
    
    }
}
