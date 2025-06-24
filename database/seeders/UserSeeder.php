<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'amir',
        //     'email' => 'amir@gmail.com',
        //     'password' => Hash::make('1234567890'),
        // ]);

        DB::table('users')->insert([
            'name' => 'amir',
            'email' => 'amir@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        
        User::factory()->count(5)->create();
    }
}
